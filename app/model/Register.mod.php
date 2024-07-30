<?php

require __DIR__ . "/../../config/constants.php";
require BASE_PATH . "config/Database.php";

class Register_mod
{
    private $db;

    public function __construct()
    {
        $this->db = Database::conn();
    }

    public function addUserToDb($data): bool
    {
        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password);";
        $stmt = $this->db->prepare($query);
        $params = [
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ];
        return $stmt->execute($params);
    }

    public function getEmailAddress($data): bool
    {
        $query = "SELECT email FROM users WHERE email = :email;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $data['email']);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result > 0;
    }
}
