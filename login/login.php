<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //validate here
    $conn = new SQLite3("../db/database.db");
    // Checking the  connection
    if (!$conn) {
        die("Failed ". mysqli_connect_error());
    }
    try {
        // validate the form data
        $passLen = strlen($password);
        $loginLen = strlen($username);
        if ($passLen<8 or $passLen>40) {
            throw new InvalidArgumentException("Password should be >8 and <40 symbols");
        }
        if ($loginLen<4 or $loginLen>40) {
            throw new InvalidArgumentException("Login should be >4 and <40 symbols");
        }
        $stmt = $conn->prepare("SELECT login, password FROM user WHERE login = :login");
        // Bind parameters
        $stmt->bindParam(':login', $username);
        $result = $stmt->execute()->fetchArray(1);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                setcookie('user_id', $result['login'], time() + 3600, '/');
            } else {
                throw new InvalidArgumentException("Password is incorrect");
            }
        } else {
            throw new InvalidArgumentException("User not found");
        }
        header("Location: /");
        $conn = null;
        exit();
    } catch (InvalidArgumentException $e) {
        // redirect back to the form with error message
        $errorMessage = $e->getMessage();
        header("Location: /login?error=$errorMessage");
        $conn = null;
        exit();
    }

    exit();
}
