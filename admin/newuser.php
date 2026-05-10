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
            $driverCode = isset($e->errorInfo[1]) ? (int) $e->errorInfo[1] : 0;
            if ($driverCode === 1062) {
                $error = 'That username is already taken. Please choose another.';
            } else {
                $error = 'Could not save the user. Check that MySQL is running, database “socialnet” exists (import db.sql), and DB settings match your server (host, port, user, password).';
            }
        }
    }
}

render_header('Admin', 'sn-body--auth');
?>
<a class="sn-brand" href="/socialnet/signin.php"><span class="sn-brand-mark">S</span><span><span class="sn-brand-text">SocialNet</span><span class="sn-brand-sub">Admin</span></span></a>
<main class="sn-main sn-main--narrow">
    <div class="sn-card">
        <h1 class="sn-h1">Create account</h1>
        <p class="sn-lead">Add a new user to the system. They can sign in from the login page.</p>
        <?php if ($error !== ''): ?><p class="sn-alert sn-alert--error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <?php if ($success !== ''): ?><p class="sn-alert sn-alert--success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

        <form class="sn-form" method="post" action="/admin/newuser.php">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required autocomplete="username">

            <label for="fullname">Full name</label>
            <input id="fullname" name="fullname" type="text" required autocomplete="name">

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">

            <label for="description">Profile content <span class="sn-label-hint">(optional)</span></label>
            <textarea id="description" name="description" rows="5" placeholder="Short bio or intro…"></textarea>

            <button class="sn-btn" type="submit">Create user</button>
        </form>
    </div>
</main>
<?php render_footer(); ?>
