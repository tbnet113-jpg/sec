<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

$user = require_login();
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim($_POST['description'] ?? '');
    $stmt = db()->prepare('UPDATE account SET description = :description WHERE id = :id');
    $stmt->execute([
        'description' => $description,
        'id' => (int) $user['id'],
    ]);
    $user['description'] = $description;
    $success = 'Profile content updated successfully.';
}

render_header('Settings');
render_menubar();
?>
<main class="sn-main">
    <div class="sn-card">
        <h1 class="sn-h1">Settings</h1>
        <p class="sn-lead">This text appears on your public profile page.</p>
        <?php if ($success !== ''): ?><p class="sn-alert sn-alert--success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

        <form class="sn-form" method="post" action="/socialnet/setting.php">
            <label for="description">Profile page content</label>
            <textarea id="description" name="description" rows="8" placeholder="Tell others about yourself…"><?= htmlspecialchars((string) ($user['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>
            <button class="sn-btn" type="submit">Save changes</button>
        </form>
    </div>
</main>
<?php render_footer(); ?>
