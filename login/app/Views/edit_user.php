<h2>Edit User</h2>

<form method="post" action="/users/update/<?= $user['id'] ?>">

    <input name="username" value="<?= $user['username'] ?>"><br>
    <input name="email" value="<?= $user['email'] ?>"><br>

    <button>Update</button>
</form>