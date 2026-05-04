<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (empty($_SESSION)) {
    header('Location: Auth/login.php', true, 302);
    exit;
}
