<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

$user = require_login();

$stmt = db()->prepare('SELECT username, fullname FROM account WHERE id <> :id ORDER BY username ASC');
$stmt->execute(['id' => (int) $user['id']]);
$otherUsers = $stmt->fetchAll();

$initial = strtoupper(substr((string) $user['username'], 0, 1));

render_header('Home');
render_menubar();
?>
<main class="sn-main">
    <div class="sn-card">
        <h1 class="sn-h1">Home</h1>
        <p class="sn-lead">Your session and people on the network.</p>

        <div class="sn-profile-row">
            <div class="sn-avatar" aria-hidden="true"><?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?></div>
            <dl class="sn-dl">
                <dt>Username</dt>
                <dd><?= htmlspecialchars((string) $user['username'], ENT_QUOTES, 'UTF-8') ?></dd>
                <dt>Full name</dt>
                <dd><?= htmlspecialchars((string) $user['fullname'], ENT_QUOTES, 'UTF-8') ?></dd>
            </dl>
        </div>

        <h2 class="sn-section-title">Other users</h2>
        <?php if (!$otherUsers): ?>
            <p class="sn-empty">No other users yet.</p>
        <?php else: ?>
            <ul class="sn-user-list">
                <?php foreach ($otherUsers as $other): ?>
                    <li>
                        <a class="sn-user-link" href="/socialnet/profile.php?owner=<?= urlencode((string) $other['username']) ?>">
                            <span class="sn-user-link-name"><?= htmlspecialchars((string) $other['username'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="sn-user-meta"><?= htmlspecialchars((string) $other['fullname'], ENT_QUOTES, 'UTF-8') ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</main>
<?php render_footer(); ?>
