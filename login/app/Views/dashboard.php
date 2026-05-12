<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Welcome, <?= session('user.username') ?></h1>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </div>

    <h2 class="mb-3">User Management System</h2>

    <!-- ADD USER BUTTON -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Add User
    </button>

    <!-- TABLE -->
    <table class="table table-bordered table-striped shadow">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach($users as $user): ?>

            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['email'] ?></td>

                <td>

                    <?php if ($user['id'] != session('user.id')): ?>

                        <!-- EDIT -->
                        <a href="#" 
                           class="btn btn-warning btn-sm"
                           data-bs-toggle="modal"
                           data-bs-target="#editUserModal"
                           onclick="openEdit(<?= htmlspecialchars(json_encode($user)) ?>)">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <a href="/users/delete/<?= $user['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this user?')">
                            Delete
                        </a>

                    <?php else: ?>
                        <span class="text-muted">This is your account</span>
                    <?php endif; ?>

                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<!-- ================= ADD USER MODAL ================= -->
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

<!-- ================= EDIT USER MODAL ================= -->
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
            <input type="text" name="username" id="edit-username" class="form-control">
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" id="edit-email" class="form-control">
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- EDIT JS -->
<script>
function openEdit(user) {
    document.getElementById('edit-id').value = user.id;
    document.getElementById('edit-username').value = user.username;
    document.getElementById('edit-email').value = user.email;

    document.getElementById('editForm').action = "/users/update/" + user.id;
}
</script>

</body>
</html>