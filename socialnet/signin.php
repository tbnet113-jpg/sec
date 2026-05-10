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

render_header('Sign in', 'sn-body--auth');
?>
<a class="sn-brand" href="/socialnet/signin.php"><span class="sn-brand-mark">S</span><span><span class="sn-brand-text">SocialNet</span><span class="sn-brand-sub">Welcome back</span></span></a>
<main class="sn-main sn-main--narrow">
    <div class="sn-card">
        <h1 class="sn-h1">Sign in</h1>
        <p class="sn-lead">Use the account created by the administrator.</p>
        <?php if ($error !== ''): ?><p class="sn-alert sn-alert--error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

        <form class="sn-form" method="post" action="/socialnet/signin.php">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required autocomplete="username">

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">

            <button class="sn-btn" type="submit">Sign in</button>
        </form>
    </div>
</main>
<?php render_footer(); ?>
