<?php

require __DIR__ . "/../../config/constants.php";
require BASE_PATH . "app/model/Login.mod.php";
require BASE_PATH . "app/helper/auth.helper.php";

class Login_cont
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new Login_mod();
    }

    private static function sanitizeInput(array $data): array
    {
        return [
            'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
            'password' => htmlspecialchars(strip_tags(trim($_POST['password']))),
        ];
    }

    private static function handleSuccessfulLogin(string $userType): void
    {
        $url = $userType === 'admin' ? ROOT_URL . "admin/homepage.php" : ROOT_URL . "user/homepage.php";
        $_SESSION['loggedIn-' . $userType] = true;
        header("Location: " . $url);
        exit();
    }

    private static function handleInvalidLogin(): void
    {
        $_SESSION['login-data'] = $_POST;
        flash('error', 'Invalid email or password.');
        header("Location: " . ROOT_URL . "auth/login.php");
        exit();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = self::sanitizeInput($_POST);

            $hashedPassword = $this->loginModel->getPassword($data['email']);
            $verifyPassword = password_verify($data['password'], $hashedPassword);

            if ($hashedPassword !== null && $verifyPassword) {
                $userType = $this->loginModel->getUserType($data['email']);
                self::handleSuccessfulLogin($userType);
            } else {
                self::handleInvalidLogin();
            }
        }
    }
}

$init = new Login_cont();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'login':
            $init->login();
            break;
        default:
    }
}
