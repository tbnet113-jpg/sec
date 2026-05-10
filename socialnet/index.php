<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

$user = require_login();

$stmt = db()->prepare('SELECT username, fullname FROM account WHERE id <> :id ORDER BY username ASC');
$stmt->execute(['id' => (int) $user['id']]);
$otherUsers = $stmt->fetchAll();

render_header('Home');
render_menubar();
?>
<h1>Home Page</h1>
<p><strong>Username:</strong> <?= htmlspecialchars((string) $user['username'], ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Full name:</strong> <?= htmlspecialchars((string) $user['fullname'], ENT_QUOTES, 'UTF-8') ?></p>

<h2>Other Users</h2>
<?php if (!$otherUsers): ?>
    <p>No other users found.</p>
<?php else: ?>
    <ul>
        <?php foreach ($otherUsers as $other): ?>
            <li>
                <a href="/socialnet/profile.php?owner=<?= urlencode((string) $other['username']) ?>">
                    <?= htmlspecialchars((string) $other['username'], ENT_QUOTES, 'UTF-8') ?>
                </a>
                - <?= htmlspecialchars((string) $other['fullname'], ENT_QUOTES, 'UTF-8') ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php render_footer(); ?>
