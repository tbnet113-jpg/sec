<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/layout.php';

require_login();

render_header('About');
render_menubar();
?>
<h1>About Page</h1>
<p><strong>Student name:</strong> Your Name</p>
<p><strong>Student number:</strong> Your Student Number</p>
<?php render_footer(); ?>
