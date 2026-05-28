@extends('layouts.app')

@section('title', 'AJAX Student List')

@section('content')
    <div class="ajax-toolbar">
        <div>
            <h1>AJAX Student Management</h1>
            <p>Load, add, update, and delete student records using jQuery AJAX.</p>
        </div>
    </div>

    <div id="ajaxMessage" class="ajax-message"></div>

    <section class="ajax-card">
        <h2 id="formTitle">Add Student</h2>

        <form id="studentForm" action="{{ route('students.store') }}" method="POST">
            @csrf
            <input type="hidden" id="studentRecordId" name="id">

            <div class="ajax-form-grid">
                <div>
                    <label for="student_id">Student ID</label>
                    <input type="text" name="student_id" id="student_id">
                </div>

                <div>
                    <label for="degree_id">Degree</label>
                    <select name="degree_id" id="degree_id">
                        <option value="">-- Select Degree --</option>
                        @foreach($degrees as $degree)
                            <option value="{{ $degree->id }}">{{ $degree->degree_title }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name">
                </div>

                <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name">
                </div>

                <div>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address">
                </div>

                <div>
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" inputmode="numeric">
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="create-only-field">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                </div>

                <div class="create-only-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
            </div>

            <div class="ajax-actions">
                <button type="submit" class="btn btn-primary" id="saveStudentBtn">
                    <i class="bi bi-save"></i>Save Student
                </button>
                <button type="button" class="btn btn-secondary" id="resetStudentBtn">
                    <i class="bi bi-arrow-counterclockwise"></i>Clear
                </button>
            </div>
        </form>
    </section>

    <section class="ajax-card">
        <h2>Student Records</h2>

        <label for="studentSearch">Search</label>
        <input type="search" id="studentSearch" placeholder="Search student name, ID, email, or degree">

        <div class="ajax-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Account ID</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Degree</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentsTableBody">
                    @forelse($students as $student)
                        <tr data-id="{{ $student->id }}">
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->user_account_id ?? 'No Account' }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->degree->degree_title ?? 'No Degree' }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="{{ route('students.show', $student) }}">
                                        <i class="bi bi-eye"></i>View
                                    </a>
                                    <button type="button" class="btn btn-warning edit-student" data-id="{{ $student->id }}">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </button>
                                    <button type="button" class="btn btn-danger delete-student" data-id="{{ $student->id }}">
                                        <i class="bi bi-trash"></i>Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="loading-row">No student records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        window.RMStudentAdmin = window.RMStudentAdmin || {};

        if (!window.RMStudentAdmin.initialized) {
            window.RMStudentAdmin.initialized = true;

            (function () {
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const form = document.getElementById('studentForm');
                const tableBody = document.getElementById('studentsTableBody');
                const message = document.getElementById('ajaxMessage');
                const formTitle = document.getElementById('formTitle');
                const saveButton = document.getElementById('saveStudentBtn');
                const recordId = document.getElementById('studentRecordId');
                const search = document.getElementById('studentSearch');
                const createOnlyFields = document.querySelectorAll('.create-only-field');
                let students = @js($students);

                function showMessage(type, text) {
                    message.className = 'ajax-message ' + type;
                    message.textContent = text;
                }

                function clearMessage() {
                    message.className = 'ajax-message';
                    message.textContent = '';
                }

                function validationMessage(response) {
                    if (response && response.errors) {
                        return Object.values(response.errors).flat().join(' ');
                    }

                    return response && response.message ? response.message : 'Something went wrong. Please try again.';
                }

                function resetForm() {
                    form.reset();
                    recordId.value = '';
                    form.action = '{{ route('students.store') }}';
                    createOnlyFields.forEach((field) => field.style.display = '');
                    formTitle.textContent = 'Add Student';
                    saveButton.innerHTML = '<i class="bi bi-save"></i>Save Student';
                }

                function escapeHtml(value) {
                    return String(value ?? '').replace(/[&<>"']/g, function (character) {
                        return {
                            '&': '&amp;',
                            '<': '&lt;',
                            '>': '&gt;',
                            '"': '&quot;',
                            "'": '&#039;',
                        }[character];
                    });
                }

                function row(student) {
                    return `
                        <tr data-id="${student.id}">
                            <td>${student.id}</td>
                            <td>${student.user_account_id || 'No Account'}</td>
                            <td>${escapeHtml(student.student_id)}</td>
                            <td>${escapeHtml(student.first_name)}</td>
                            <td>${escapeHtml(student.last_name)}</td>
                            <td>${escapeHtml(student.degree ? student.degree.degree_title : 'No Degree')}</td>
                            <td>${escapeHtml(student.email)}</td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="/students/${student.id}">
                                        <i class="bi bi-eye"></i>View
                                    </a>
                                    <button type="button" class="btn btn-warning edit-student" data-id="${student.id}">
                                        <i class="bi bi-pencil-square"></i>Edit
                                    </button>
                                    <button type="button" class="btn btn-danger delete-student" data-id="${student.id}">
                                        <i class="bi bi-trash"></i>Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                }

                function render() {
                    const term = search.value.toLowerCase().trim();
                    const visible = term
                        ? students.filter((student) => [
                            student.student_id,
                            student.first_name,
                            student.last_name,
                            student.email,
                            student.contact_number,
                            student.degree ? student.degree.degree_title : '',
                        ].join(' ').toLowerCase().includes(term))
                        : students;

                    tableBody.innerHTML = visible.length
                        ? visible.map(row).join('')
                        : '<tr><td colspan="8" class="loading-row">No student records found.</td></tr>';
                }

                async function loadStudents() {
                    try {
                        const response = await fetch('{{ route('students.ajax.index') }}', {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        });

                        if (!response.ok) {
                            throw new Error('Unable to load students.');
                        }

                        const payload = await response.json();
                        students = payload.students || [];
                        render();
                    } catch (error) {
                        showMessage('error', 'Unable to load students. Please refresh or login again.');
                    }
                }

                form.addEventListener('submit', async function (event) {
                    event.preventDefault();
                    clearMessage();

                    const id = recordId.value;
                    const formData = new FormData(form);

                    if (id) {
                        formData.append('_method', 'PUT');
                    }

                    try {
                        const response = await fetch(id ? `/students/${id}` : '{{ route('students.store') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        });

                        const payload = await response.json().catch(() => ({}));

                        if (!response.ok) {
                            showMessage('error', validationMessage(payload));
                            return;
                        }

                        showMessage('success', payload.message || 'Student saved successfully.');
                        resetForm();
                        await loadStudents();
                    } catch (error) {
                        showMessage('error', 'Unable to save student. Please check your connection and try again.');
                    }
                });

                document.getElementById('resetStudentBtn').addEventListener('click', function () {
                    clearMessage();
                    resetForm();
                    render();
                });

                search.addEventListener('input', render);

                tableBody.addEventListener('click', async function (event) {
                    const editButton = event.target.closest('.edit-student');
                    const deleteButton = event.target.closest('.delete-student');

                    if (editButton) {
                        const student = students.find((record) => String(record.id) === String(editButton.dataset.id));

                        if (!student) {
                            return;
                        }

                        clearMessage();
                        recordId.value = student.id;
                        form.action = `/students/${student.id}`;
                        document.getElementById('student_id').value = student.student_id || '';
                        document.getElementById('first_name').value = student.first_name || '';
                        document.getElementById('last_name').value = student.last_name || '';
                        document.getElementById('address').value = student.address || '';
                        document.getElementById('contact_number').value = student.contact_number || '';
                        document.getElementById('email').value = student.email || '';
                        document.getElementById('degree_id').value = student.degree_id || '';
                        document.getElementById('username').value = '';
                        document.getElementById('password').value = '';
                        createOnlyFields.forEach((field) => field.style.display = 'none');
                        formTitle.textContent = `Update ${student.first_name} ${student.last_name}`;
                        saveButton.innerHTML = '<i class="bi bi-check2-circle"></i>Update Student';
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }

                    if (deleteButton) {
                        const id = deleteButton.dataset.id;

                        if (!confirm('Are you sure you want to delete this student?')) {
                            return;
                        }

                        clearMessage();

                        try {
                            const formData = new FormData();
                            formData.append('_method', 'DELETE');
                            formData.append('_token', csrf);

                            const response = await fetch(`/students/${id}`, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': csrf,
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                                credentials: 'same-origin',
                            });

                            const payload = await response.json().catch(() => ({}));

                            if (!response.ok) {
                                showMessage('error', validationMessage(payload));
                                return;
                            }

                            showMessage('success', payload.message || 'Student deleted successfully.');
                            await loadStudents();
                        } catch (error) {
                            showMessage('error', 'Unable to delete student. Please try again.');
                        }
                    }
                });

                loadStudents();
            })();
        }
    </script>
@endsection
