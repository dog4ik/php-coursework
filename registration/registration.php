<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $conn = new SQLite3("../db/database.db");
    if (!$conn) {
        die("Failed ". mysqli_connect_error());
    }
    try {
        // validate the form data
        if ($password !== $repeat_password) {
            throw new InvalidArgumentException("Passwords dont match");
        }
        $passLen = strlen($password);
        $loginLen = strlen($username);
        if ($passLen<8 or $passLen>40) {
            throw new InvalidArgumentException("Password should be >8 and <40 symbols");
        }
        if ($loginLen<4 or $loginLen>40) {
            throw new InvalidArgumentException("Login should be >4 and <40 symbols");
        }
        $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

        if (!$hashed_password) {
            throw new InvalidArgumentException("Hashing error");
        }
        $stmt = $conn->prepare("INSERT INTO user (login, password) VALUES (:login, :password)");
        // Bind parameters
        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':password', $hashed_password);
        //WARN: detect bullshit
        $query_result = $stmt->execute();
        if ($query_result!==false) {
            setcookie('user_id', $username, time() + 3600, '/');
        } else {
            throw new InvalidArgumentException("User already exists");
        }
        header("Location: /");
        $conn = null;
        exit();
    } catch (InvalidArgumentException $e) {
        // redirect back to the form with error message
        $errorMessage = $e->getMessage();
        header("Location: /registration?error=$errorMessage");
        $conn = null;
        exit();
    }


}
