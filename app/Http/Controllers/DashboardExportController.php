<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardExportController extends Controller
{
    public function pdf(Request $request, string $dashboard)
    {
        $this->authorizeDashboard($request, $dashboard);
        $data = $this->dashboardData($request, $dashboard);
        $fileName = $dashboard . '-dashboard-report-' . now()->format('Ymd-His') . '.pdf';

        return response()
            ->make($this->buildPdf($dashboard, $data), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]);
    }

    public function excel(Request $request, string $dashboard): StreamedResponse
    {
        $this->authorizeDashboard($request, $dashboard);

        $data = $this->dashboardData($request, $dashboard);
        $fileName = $dashboard . '-dashboard-export-' . now()->format('Ymd-His') . '.csv';

        return response()->streamDownload(function () use ($dashboard, $data) {
            $output = fopen('php://output', 'w');

            if ($dashboard === 'admin') {
                fputcsv($output, ['Admin Dashboard Summary']);
                fputcsv($output, ['Students', $data['studentCount']]);
                fputcsv($output, ['Teachers', $data['teacherCount']]);
                fputcsv($output, []);
                fputcsv($output, ['Student ID', 'Name', 'Email', 'Degree', 'Contact Number']);

                foreach ($data['students'] as $student) {
                    fputcsv($output, [
                        $student->student_id,
                        $student->first_name . ' ' . $student->last_name,
                        $student->email,
                        $student->degree->degree_title ?? 'No Degree',
                        $student->contact_number,
                    ]);
                }

                fputcsv($output, []);
                fputcsv($output, ['Teacher Username', 'Email', 'Status']);

                foreach ($data['teachers'] as $teacher) {
                    fputcsv($output, [$teacher->username, $teacher->email, $teacher->is_active ? 'Active' : 'Inactive']);
                }
            } elseif ($dashboard === 'student') {
                fputcsv($output, ['Student Dashboard']);
                fputcsv($output, ['Student ID', $data['student']->student_id ?? '']);
                fputcsv($output, ['Name', $data['student'] ? $data['student']->first_name . ' ' . $data['student']->last_name : '']);
                fputcsv($output, ['Email', $data['student']->email ?? '']);
                fputcsv($output, ['Degree', $data['student']->degree->degree_title ?? 'No Degree']);
            } else {
                fputcsv($output, ['Teacher Dashboard']);
                fputcsv($output, ['Username', $data['teacher']->username ?? '']);
                fputcsv($output, ['Email', $data['teacher']->email ?? '']);
                fputcsv($output, ['Status', ($data['teacher']?->is_active ?? false) ? 'Active' : 'Inactive']);
            }

            fclose($output);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function authorizeDashboard(Request $request, string $dashboard): void
    {
        abort_unless(in_array($dashboard, ['admin', 'student', 'teacher'], true), 404);

        $role = $request->session()->get('user_role');
        abort_unless($role === 'admin' || $role === $dashboard, 403);
    }

    private function dashboardData(Request $request, string $dashboard): array
    {
        if ($dashboard === 'admin') {
            return [
                'dashboard' => $dashboard,
                'studentCount' => Student::count(),
                'teacherCount' => UserAccount::where('role', 'teacher')->count(),
                'students' => Student::with('degree')->orderBy('last_name')->get(),
                'teachers' => UserAccount::where('role', 'teacher')->orderBy('username')->get(),
            ];
        }

        if ($dashboard === 'student') {
            return [
                'dashboard' => $dashboard,
                'student' => Student::with('degree')
                    ->where('user_account_id', $request->session()->get('user_account_id'))
                    ->first(),
            ];
        }

        return [
            'dashboard' => $dashboard,
            'teacher' => UserAccount::find($request->session()->get('user_account_id')),
        ];
    }

    private function buildPdf(string $dashboard, array $data): string
    {
        $lines = [
            strtoupper($dashboard) . ' DASHBOARD REPORT',
            'Generated: ' . now()->format('M d, Y h:i A'),
            '',
        ];

        if ($dashboard === 'admin') {
            $lines[] = 'Students: ' . $data['studentCount'];
            $lines[] = 'Teachers: ' . $data['teacherCount'];
            $lines[] = 'Total Users: ' . ($data['studentCount'] + $data['teacherCount']);
            $lines[] = '';
            $lines[] = 'STUDENTS';

            foreach ($data['students'] as $student) {
                $lines[] = trim($student->student_id . ' | ' . $student->first_name . ' ' . $student->last_name . ' | ' . $student->email . ' | ' . ($student->degree->degree_title ?? 'No Degree'));
            }

            $lines[] = '';
            $lines[] = 'TEACHERS';

            foreach ($data['teachers'] as $teacher) {
                $lines[] = $teacher->username . ' | ' . $teacher->email . ' | ' . ($teacher->is_active ? 'Active' : 'Inactive');
            }
        } elseif ($dashboard === 'student') {
            $student = $data['student'];
            $lines[] = 'Student ID: ' . ($student->student_id ?? 'No Profile');
            $lines[] = 'Name: ' . ($student ? $student->first_name . ' ' . $student->last_name : 'No Profile');
            $lines[] = 'Email: ' . ($student->email ?? 'No Profile');
            $lines[] = 'Degree: ' . ($student->degree->degree_title ?? 'No Degree');
        } else {
            $teacher = $data['teacher'];
            $lines[] = 'Username: ' . ($teacher->username ?? 'No Account');
            $lines[] = 'Email: ' . ($teacher->email ?? 'No Account');
            $lines[] = 'Status: ' . (($teacher?->is_active ?? false) ? 'Active' : 'Inactive');
        }

        return $this->plainTextPdf($lines);
    }

    private function plainTextPdf(array $lines): string
    {
        $objects = [];
        $pages = array_chunk($lines, 42);
        $pageObjectIds = [];

        $objects[] = '<< /Type /Catalog /Pages 2 0 R >>';
        $objects[] = '';

        foreach ($pages as $pageLines) {
            $pageId = count($objects) + 1;
            $contentId = $pageId + 1;
            $pageObjectIds[] = $pageId . ' 0 R';

            $objects[] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 << /Type /Font /Subtype /Type1 /BaseFont /Courier >> >> >> /Contents ' . $contentId . ' 0 R >>';

            $text = "BT\n/F1 10 Tf\n50 750 Td\n14 TL\n";
            foreach ($pageLines as $line) {
                $text .= '(' . $this->escapePdfText(substr((string) $line, 0, 92)) . ") Tj\nT*\n";
            }
            $text .= 'ET';

            $objects[] = '<< /Length ' . strlen($text) . " >>\nstream\n" . $text . "\nendstream";
        }

        $objects[1] = '<< /Type /Pages /Kids [' . implode(' ', $pageObjectIds) . '] /Count ' . count($pageObjectIds) . ' >>';

        $pdf = "%PDF-1.4\n";
        $offsets = [0];

        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($index + 1) . " 0 obj\n" . $object . "\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf('%010d 00000 n ', $offsets[$i]) . "\n";
        }

        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xrefOffset . "\n%%EOF";

        return $pdf;
    }

    private function escapePdfText(string $text): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }
}
