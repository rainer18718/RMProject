import './bootstrap';

$(function () {
    const $studentForm = $('#studentForm');

    if (!$studentForm.length) {
        return;
    }

    const $tableBody = $('#studentsTableBody');
    const $message = $('#ajaxMessage');
    const $formTitle = $('#formTitle');
    const $saveButton = $('#saveStudentBtn');
    const $recordId = $('#studentRecordId');
    const syncKey = 'students-table-updated-at';
    let lastSyncValue = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest',
        },
    });

    function showMessage(type, text) {
        $message
            .removeClass('success error')
            .addClass(type)
            .text(text);
    }

    function clearMessage() {
        $message.removeClass('success error').text('');
    }

    function validationMessage(xhr) {
        if (xhr.responseJSON && xhr.responseJSON.errors) {
            return Object.values(xhr.responseJSON.errors).flat().join(' ');
        }

        if (xhr.responseJSON && xhr.responseJSON.message) {
            return xhr.responseJSON.message;
        }

        return 'Something went wrong. Please try again.';
    }

    function resetForm() {
        $studentForm[0].reset();
        $recordId.val('');
        $('.create-only-field').show();
        $formTitle.text('Add Student');
        $saveButton.html('<i class="bi bi-save"></i>Save Student');
    }

    function studentRow(student) {
        const encodedStudent = encodeURIComponent(JSON.stringify(student));

        return `
            <tr data-id="${student.id}">
                <td>${student.id}</td>
                <td>${student.user_account_id || 'No Account'}</td>
                <td>${student.student_id || ''}</td>
                <td>${student.first_name || ''}</td>
                <td>${student.last_name || ''}</td>
                <td>${student.degree ? student.degree.degree_title : 'No Degree'}</td>
                <td>${student.email || ''}</td>
                <td>
                    <div class="actions">
                        <button type="button" class="btn btn-warning edit-student" data-student="${encodedStudent}">
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

    function loadStudents() {
        $tableBody.html('<tr><td colspan="8" class="loading-row">Loading students...</td></tr>');

        $.get('/students/ajax/list')
            .done(function (response) {
                if (!response.students.length) {
                    $tableBody.html('<tr><td colspan="8" class="loading-row">No student records found.</td></tr>');
                    return;
                }

                $tableBody.html(response.students.map(studentRow).join(''));
            })
            .fail(function () {
                $tableBody.html('<tr><td colspan="8" class="loading-row">Unable to load students.</td></tr>');
            });
    }

    function syncOtherOpenPages() {
        localStorage.setItem(syncKey, Date.now().toString());
    }

    $studentForm.on('submit', function (event) {
        event.preventDefault();
        clearMessage();

        const id = $recordId.val();
        const url = id ? `/students/${id}` : '/students';
        const formData = $studentForm.serializeArray();

        if (id) {
            formData.push({ name: '_method', value: 'PUT' });
        }

        $.post(url, $.param(formData))
            .done(function (response) {
                showMessage('success', response.message);
                resetForm();
                loadStudents();
                syncOtherOpenPages();
            })
            .fail(function (xhr) {
                showMessage('error', validationMessage(xhr));
            });
    });

    $('#resetStudentBtn').on('click', function () {
        clearMessage();
        resetForm();
    });

    $tableBody.on('click', '.edit-student', function () {
        const student = JSON.parse(decodeURIComponent($(this).attr('data-student')));

        clearMessage();
        $recordId.val(student.id);
        $('#student_id').val(student.student_id);
        $('#first_name').val(student.first_name);
        $('#last_name').val(student.last_name);
        $('#address').val(student.address);
        $('#contact_number').val(student.contact_number);
        $('#email').val(student.email);
        $('#degree_id').val(student.degree_id);
        $('#username').val('');
        $('#password').val('');
        $('.create-only-field').hide();
        $formTitle.text(`Update ${student.first_name} ${student.last_name}`);
        $saveButton.html('<i class="bi bi-check2-circle"></i>Update Student');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    $tableBody.on('click', '.delete-student', function () {
        const id = $(this).data('id');

        if (!confirm('Are you sure you want to delete this student?')) {
            return;
        }

        clearMessage();

        $.ajax({
            url: `/students/${id}`,
            method: 'POST',
            data: {
                _method: 'DELETE',
            },
        })
            .done(function (response) {
                showMessage('success', response.message);
                loadStudents();
                syncOtherOpenPages();
            })
            .fail(function (xhr) {
                showMessage('error', validationMessage(xhr));
            });
    });

    window.addEventListener('storage', function (event) {
        if (event.key === syncKey && event.newValue !== lastSyncValue) {
            lastSyncValue = event.newValue;
            loadStudents();
        }
    });

    loadStudents();
});
