<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

$loggedInUser = require_login();
$ownerUsername = trim($_GET['owner'] ?? '');

if ($ownerUsername === '') {
    $ownerUsername = (string) $loggedInUser['username'];
}

$stmt = db()->prepare('SELECT username, fullname, description FROM account WHERE username = :username LIMIT 1');
$stmt->execute(['username' => $ownerUsername]);
$owner = $stmt->fetch();

render_header('Profile');
render_menubar();
?>
<h1>Profile Page</h1>
<?php if (!$owner): ?>
    <p class="error">User not found: <?= htmlspecialchars($ownerUsername, ENT_QUOTES, 'UTF-8') ?></p>
<?php else: ?>
    <p><strong>Owner:</strong> <?= htmlspecialchars((string) $owner['username'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Full name:</strong> <?= htmlspecialchars((string) $owner['fullname'], ENT_QUOTES, 'UTF-8') ?></p>
    <h2>Profile Content</h2>
    <p><?= nl2br(htmlspecialchars((string) ($owner['description'] ?? ''), ENT_QUOTES, 'UTF-8')) ?></p>
<?php endif; ?>
<?php render_footer(); ?>
