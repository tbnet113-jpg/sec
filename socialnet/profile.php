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

$avatarLetter = $owner
    ? strtoupper(substr((string) $owner['username'], 0, 1))
    : '?';

render_header('Profile');
render_menubar();
?>
<main class="sn-main">
    <div class="sn-card">
        <h1 class="sn-h1">Profile</h1>
        <p class="sn-lead">Public information for this account.</p>

        <?php if (!$owner): ?>
            <p class="sn-alert sn-alert--error">User not found: <strong><?= htmlspecialchars($ownerUsername, ENT_QUOTES, 'UTF-8') ?></strong></p>
        <?php else: ?>
            <div class="sn-profile-row">
                <div class="sn-avatar" aria-hidden="true"><?= htmlspecialchars($avatarLetter, ENT_QUOTES, 'UTF-8') ?></div>
                <dl class="sn-dl">
                    <dt>Owner</dt>
                    <dd><?= htmlspecialchars((string) $owner['username'], ENT_QUOTES, 'UTF-8') ?></dd>
                    <dt>Full name</dt>
                    <dd><?= htmlspecialchars((string) $owner['fullname'], ENT_QUOTES, 'UTF-8') ?></dd>
                </dl>
            </div>

            <h2 class="sn-section-title">About</h2>
            <div class="sn-profile-body">
                <?php
                $desc = trim((string) ($owner['description'] ?? ''));
                if ($desc === '') {
                    echo '<span class="sn-empty">No profile content yet.</span>';
                } else {
                    echo nl2br(htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'));
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php render_footer(); ?>
