<?php
if (!isset($_SESSION)) {
    session_start();
}

function flash($type = null, $message = null)
{
    if ($type !== null && $message !== null) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    } elseif ($type === null && $message === null) {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
    }
}

function flash_message()
{
    $flash = flash();
    if ($flash) {
        echo '<div class="flash-message ' . htmlspecialchars($flash['type']) . '">';
        echo htmlspecialchars($flash['message']);
        echo '</div>';
    }
}


$first_name = $_SESSION['registration-data']['first_name'] ?? '';
$last_name = $_SESSION['registration-data']['last_name'] ?? '';
$email = $_SESSION['registration-data']['email'] ?? '';
$username = $_SESSION['registration-data']['username'] ?? '';
$password = $_SESSION['registration-data']['password'] ?? '';
$confirm_password = $_SESSION['registration-data']['confirm_password'] ?? '';
unset($_SESSION['registration-data']);
