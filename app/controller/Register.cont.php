<?php

require __DIR__ . "/../../config/constants.php";
require BASE_PATH . "app/model/Register.mod.php";
require BASE_PATH . "app/helper/auth.helper.php";

class Register_cont
{
    private $registerModel;
    const PASSWORD_LENGTH = 3;

    public function __construct()
    {
        $this->registerModel = new Register_mod();
    }

    private function validateInputs($data)
    {
        $errors = [];

        if (empty($data['first_name'])) {
            $errors[] = 'First name is required.';
        } elseif (!preg_match("/^[a-zA-Z]+$/", $data['first_name'])) {
            $errors[] = 'First name can only contain alphabetic characters.';
        }

        if (empty($data['last_name'])) {
            $errors[] = 'Last name is required.';
        } elseif (!preg_match("/^[a-zA-Z]+$/", $data['last_name'])) {
            $errors[] = 'Last name can only contain alphabetic characters.';
        }

        if (empty($data['email'])) {
            $errors[] = 'Email is required.';
        }

        if ($this->registerModel->getEmailAddress($data)) {
            $errors[] = 'Email already in use.';
        }

        if (empty($data['password'])) {
            $errors[] = 'Password is required.';
        }

        if (strlen($data['password']) < self::PASSWORD_LENGTH) {
            $errors[] = 'Password should be at least 8 characters.';
        }

        if (empty($data['confirm_password'])) {
            $errors[] = 'Confirm your password.';
        }

        if ($data['password'] != $data['confirm_password']) {
            $errors[] = 'Passwords does not match.';
        }

        if (!empty($errors)) {
            foreach ($errors as $err) {
                flash('error', $err);
            }
            return false;
        }
        return true;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'first_name' => htmlspecialchars(strip_tags(trim($_POST['first_name']))),
                'last_name' => htmlspecialchars(strip_tags(trim($_POST['last_name']))),
                'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
                'password' => htmlspecialchars(strip_tags(trim($_POST['password']))),
                'confirm_password' => htmlspecialchars(strip_tags(trim($_POST['confirm_password']))),
            ];

            if ($this->validateInputs($data)) {
                $this->registerModel->addUserToDb($data);

                flash('success', 'Registration successful!');
                header("Location: " . ROOT_URL . "auth/register.php");
                exit();
            } else {
                $_SESSION['registration-data'] = $_POST;

                header("Location: " . ROOT_URL . "auth/register.php");
                exit();
            }
        }
    }
}

$init = new Register_cont();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        default: // Handle other cases if needed
    }
}
