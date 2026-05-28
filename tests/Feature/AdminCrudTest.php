<?php

namespace Tests\Feature;

use App\Models\Degree;
use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_student_records(): void
    {
        $degree = Degree::create(['degree_title' => 'BS Information Technology']);

        $this->adminSession()
            ->post('/students', [
                'student_id' => 'S-100',
                'first_name' => 'Ana',
                'last_name' => 'Reyes',
                'address' => 'Manila',
                'contact_number' => '09123456789',
                'email' => 'ana@example.com',
                'degree_id' => $degree->id,
                'username' => 'ana.reyes',
                'password' => 'password123',
            ])
            ->assertRedirect('/students');

        $student = Student::where('email', 'ana@example.com')->firstOrFail();
        $this->assertDatabaseHas('user_accounts', ['username' => 'ana.reyes', 'role' => 'student']);

        $this->adminSession()
            ->get('/students/ajax/list')
            ->assertOk()
            ->assertJsonPath('students.0.email', 'ana@example.com');

        $this->adminSession()
            ->get('/students')
            ->assertOk()
            ->assertSee('ana@example.com')
            ->assertDontSee('Loading students...');

        $this->adminSession()
            ->put('/students/' . $student->id, [
                'student_id' => 'S-101',
                'first_name' => 'Ana',
                'last_name' => 'Santos',
                'address' => 'Quezon City',
                'contact_number' => '09987654321',
                'email' => 'ana.santos@example.com',
                'degree_id' => $degree->id,
            ])
            ->assertRedirect('/students');

        $this->assertDatabaseHas('students', ['student_id' => 'S-101', 'email' => 'ana.santos@example.com']);

        $this->adminSession()
            ->delete('/students/' . $student->id)
            ->assertRedirect('/students');

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_admin_can_manage_teacher_accounts(): void
    {
        $this->adminSession()
            ->post('/teachers', [
                'username' => 'teacher.one',
                'email' => 'teacher@example.com',
                'password' => 'password123',
            ])
            ->assertRedirect(route('teachers.index'));

        $teacher = UserAccount::where('email', 'teacher@example.com')->firstOrFail();

        $this->adminSession()->get('/teachers/' . $teacher->id)->assertOk();

        $this->adminSession()
            ->put('/teachers/' . $teacher->id, [
                'username' => 'teacher.two',
                'email' => 'teacher.two@example.com',
                'password' => '',
                'is_active' => 1,
            ])
            ->assertRedirect(route('teachers.index'));

        $this->assertDatabaseHas('user_accounts', ['id' => $teacher->id, 'username' => 'teacher.two']);

        $this->adminSession()
            ->delete('/teachers/' . $teacher->id)
            ->assertRedirect(route('teachers.index'));

        $this->assertDatabaseMissing('user_accounts', ['id' => $teacher->id]);
    }

    public function test_dashboard_exports_are_available(): void
    {
        $this->adminSession()
            ->get('/dashboards/admin/export/pdf')
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');

        $this->adminSession()
            ->get('/dashboards/admin/export/excel')
            ->assertOk()
            ->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }

    public function test_default_admin_can_login_with_email(): void
    {
        $this->seed(\Database\Seeders\DefaultAdminSeeder::class);

        $this->post('/', [
            'username' => 'admin@rm.com',
            'password' => 'admin123',
        ])->assertRedirect(route('dashboard'));
    }

    private function adminSession(): self
    {
        $admin = UserAccount::firstOrCreate(
            ['email' => 'admin@rm.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => 1,
            ]
        );

        return $this->withSession([
            'user_account_id' => $admin->id,
            'user_role' => 'admin',
        ]);
    }
}
