<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 420px;">

        <h2 class="text-center mb-4">Register</h2>

        <form method="post" action="/register">

            <div class="mb-3">
                <input name="username" class="form-control" placeholder="Username">
            </div>

            <div class="mb-3">
                <input name="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>

            <button class="btn btn-success w-100">
                Register
            </button>

        </form>

        <p class="text-center mt-3">
            Have an account?
            <a href="/login">Login now</a>
        </p>

    </div>

</div>

</body>
</html>