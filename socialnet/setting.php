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

render_header('Setting');
render_menubar();
?>
<h1>Setting Page</h1>
<p>Update your profile page content below:</p>
<?php if ($success !== ''): ?><p class="success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

<form method="post" action="/socialnet/setting.php">
    <label for="description">Profile Page Content</label>
    <textarea id="description" name="description" rows="8"><?= htmlspecialchars((string) ($user['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>
    <button type="submit">Save</button>
</form>
<?php render_footer(); ?>
