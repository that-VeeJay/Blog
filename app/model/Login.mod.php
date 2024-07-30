<?php

require __DIR__ . "/../../config/constants.php";
require BASE_PATH . "config/Database.php";

class Login_mod
{
    private $db;

    public function __construct()
    {
        $this->db = Database::conn();
    }

    public function getPassword(string $email)
    {
        $query = "SELECT password FROM users WHERE email = :email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $password = $stmt->fetchColumn();
        return $password === false ? null : $password;
    }

    public function getUserType(string $email)
    {
        $query = "SELECT user_type FROM users WHERE email = :email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user_type = $stmt->fetchColumn();
        return $user_type === false ? null : $user_type;
    }

    public function __destruct()
    {
        $this->db = null;
    }
}
