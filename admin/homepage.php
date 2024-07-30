<?php
require __DIR__ . "/../config/constants.php";

if (!isset($_SESSION['loggedIn-admin'])) {
    header('Location: ' . ROOT_URL . 'auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>

<body>
    <h1>This is the ADMIN page</h1>

    <a href="../auth/logout.php">Logout</a>
</body>

</html>