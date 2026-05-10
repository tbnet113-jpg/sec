<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

$error = '';

if (current_user() !== null) {
    header('Location: /socialnet/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Username and password are required.';
    } else {
        $stmt = db()->prepare('SELECT id, password FROM account WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $account = $stmt->fetch();

        if (!$account || !password_verify($password, (string) $account['password'])) {
            $error = 'Invalid username or password.';
        } else {
            login_user((int) $account['id']);
            header('Location: /socialnet/index.php');
            exit;
        }
    }
}

render_header('Sign In');
?>
<h1>Sign In</h1>
<?php if ($error !== ''): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

<form method="post" action="/socialnet/signin.php">
    <label for="username">Username</label>
    <input id="username" name="username" type="text" required>

    <label for="password">Password</label>
    <input id="password" name="password" type="password" required>

    <button type="submit">Sign In</button>
</form>
<?php render_footer(); ?>
