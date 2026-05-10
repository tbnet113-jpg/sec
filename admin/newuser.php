<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/layout.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $password = $_POST['password'] ?? '';
    $description = trim($_POST['description'] ?? '');

    if ($username === '' || $fullname === '' || $password === '') {
        $error = 'Username, fullname and password are required.';
    } else {
        try {
            $stmt = db()->prepare(
                'INSERT INTO account (username, fullname, password, description) VALUES (:username, :fullname, :password, :description)'
            );
            $stmt->execute([
                'username' => $username,
                'fullname' => $fullname,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'description' => $description,
            ]);
            $success = 'User created successfully.';
        } catch (PDOException $e) {
            $error = 'Could not create user. Username may already exist.';
        }
    }
}

render_header('Admin - New User');
?>
<h1>Admin Page - Create New User</h1>
<?php if ($error !== ''): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
<?php if ($success !== ''): ?><p class="success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

<form method="post" action="/admin/newuser.php">
    <label for="username">Username</label>
    <input id="username" name="username" type="text" required>

    <label for="fullname">Full name</label>
    <input id="fullname" name="fullname" type="text" required>

    <label for="password">Password</label>
    <input id="password" name="password" type="password" required>

    <label for="description">Profile content</label>
    <textarea id="description" name="description" rows="6"></textarea>

    <button type="submit">Create User</button>
</form>
<?php render_footer(); ?>
