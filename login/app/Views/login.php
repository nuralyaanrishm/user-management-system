<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <h2 class="text-center mb-4">Login</h2>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/login">

            <div class="mb-3">
                <input name="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>

            <button class="btn btn-primary w-100">
                Login
            </button>

        </form>

        <p class="text-center mt-3">
            Don't have an account yet?
            <a href="/register">Register now</a>
        </p>

    </div>

</div>

</body>
</html>