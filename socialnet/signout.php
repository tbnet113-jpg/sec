<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';

logout_user();
header('Location: /socialnet/signin.php');
exit;
