<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<!--navbar--> 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">

    <!-- LEFT: System name -->
    <div class="navbar-brand">
    User Management System
    </div>

    <!-- RIGHT: Logout -->
    <div class="ms-auto">
        <a href="/logout" class="btn btn-danger btn-sm">
            Logout
        </a>
    </div>

</nav>

<body class="d-flex flex-column min-vh-100">

<div class="container mt-5">

    <!--untuk display hello user-->
    <div class="navbar-brand">
      <h2>  Welcome, <?= session('user.username') ?>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">

    <!-- LEFT: Add User button -->
    <button class="btn btn-success btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#addUserModal">
        Add User
    </button>

    <!-- RIGHT: Search bar -->
    <div style="width: 340px;">
        <input type="text" id="searchInput"
               class="form-control form-control-sm"
               placeholder="Search user...">
    </div>

</div>

    <table class="table table-bordered table-striped shadow">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="userTableBody">
        </tbody>

    </table>

</div>


<!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="/users/store">

                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Create</button>
                </div>

            </form>

        </div>
    </div>
</div>


<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" id="editForm">

                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="id" id="edit-id">

                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" id="edit-username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Leave blank if no change">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
function loadUsers(search = '') {

$.ajax({
    url: "/users/list",
    method: "GET",
    data: { search: search },
    dataType: "json",

    success: function(users) {

        let html = '';

        users.forEach(function(user) {

            if (user.email === 'admin@gmail.com') return;

            html += `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick='openEdit(${JSON.stringify(user)})'
                            data-bs-toggle="modal"
                            data-bs-target="#editUserModal">
                            Edit
                        </button>

                        <a href="/users/delete/${user.id}"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this user?')">
                           Delete
                        </a>
                    </td>
                </tr>
            `;
        });

        $('#userTableBody').html(html);
    }
});
}


function openEdit(user) {

    $('#edit-id').val(user.id);

    $('#edit-username').val(user.username);
    $('#edit-email').val(user.email);

    $('#edit-username').attr('placeholder', user.username);
    $('#edit-email').attr('placeholder', user.email);

    $('#editForm').attr('action', '/users/update/' + user.id);
}

$(document).ready(function() {

loadUsers();

$('#searchInput').on('keyup', function() {
    let value = $(this).val();
    loadUsers(value);
});

});

$(document).ready(function() {
    loadUsers();
});
</script>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    © <?= date('Y') ?> User Management System
</footer>

</body>
</html>
