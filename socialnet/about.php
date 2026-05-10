<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

require_login();

render_header('About');
render_menubar();
?>
<main class="sn-main">
    <div class="sn-card">
        <h1 class="sn-h1">About</h1>
        <p class="sn-lead">Course submission details.</p>

        <dl class="sn-dl" style="margin-top:8px">
            <dt>Student name</dt>
            <dd>NguyenNhatMinh</dd>
            <dt>Student number</dt>
            <dd>1701787</dd>
        </dl>
    </div>
</main>
<?php render_footer(); ?>
