<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function ensure_session_started(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function login_user(int $accountId): void
{
    ensure_session_started();
    $_SESSION['account_id'] = $accountId;
}

function current_user(): ?array
{
    ensure_session_started();

    if (!isset($_SESSION['account_id'])) {
        return null;
    }

    try {
        $stmt = db()->prepare('SELECT id, username, fullname, description FROM account WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => (int) $_SESSION['account_id']]);
        $user = $stmt->fetch();

        return $user ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function require_login(): array
{
    $user = current_user();
    if ($user === null) {
        header('Location: /socialnet/signin.php');
        exit;
    }

    return $user;
}

function logout_user(): void
{
    ensure_session_started();
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}
