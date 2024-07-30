<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!defined('ROOT_URL')) {
    define('ROOT_URL', 'http://blog.com/');
}

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '/../');
}
