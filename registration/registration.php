<?php

/**
 * @var PDO $conn The database connection
 */
$conn = require_once("../db_connection.php");
session_start();
if ($_POST) {
    $full_phone = $_POST['phone'];
    $name = $_POST['name'];
    $second_name = $_POST['second_name'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $regex = "/^(\s|\()?\d{3}(\s|\))?\d{3}(-|\s)?\d{2}(-|\s)?\d{2}$/";
    try {
        // validate the form data
        if ($password !== $repeat_password) {
            throw new InvalidArgumentException("Passwords dont match");
        }
        $passLen = strlen($password);
        $nameLen = strlen($name);
        $second_nameLen = strlen($second_name);
        if ($passLen<8 or $passLen>40) {
            throw new InvalidArgumentException("Password should be >8 and <40 symbols");
        }
        if ($nameLen<2 or $nameLen>15) {
            throw new InvalidArgumentException("Name should be >2 and <15 symbols");
        }
        if ($second_nameLen<2 or $second_nameLen>20) {
            throw new InvalidArgumentException("Second name should be >2 and <20 symbols");
        }

        if (!preg_match($regex, $full_phone)) {
            throw new InvalidArgumentException("Phone is not correct");
        }
        $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

        if (!$hashed_password) {
            throw new InvalidArgumentException("Hashing error");
        }
        $user_uuid = uniqid();
        $phone_numbers = (int)preg_replace("/[^0-9]/", "", $full_phone);
        $user_query = $conn->prepare("INSERT INTO user (password, id, phone, name, second_name) VALUES (:password, :id, :phone, :name, :second_name)");
        // Bind parameters
        $user_query->bindParam(':id', $user_uuid);
        $user_query->bindParam(':phone', $phone_numbers);
        $user_query->bindParam(':password', $hashed_password);
        $user_query->bindParam(':name', $name);
        $user_query->bindParam(':second_name', $second_name);
        $user_query_result = $user_query->execute();
        $balance_uuid = uniqid();
        $balance_query = $conn->prepare("INSERT INTO balance (id, user_id) VALUES (:id, :user_id)");
        $balance_query->bindParam("id", $balance_uuid);
        $balance_query->bindParam("user_id", $user_uuid);
        $balance_query_result = $balance_query->execute();
        if ($user_query_result!==false && $balance_query_result!==false) {
            $_SESSION['user_id']=$user_uuid;
        } else {
            throw new InvalidArgumentException("User already exists");
        }
        header("Location: /");
        exit();
    } catch (InvalidArgumentException $e) {
        // redirect back to the form with error message
        $errorMessage = $e->getMessage();
        header("Location: /registration");
        $_SESSION['errMsg'] = $errorMessage;
        exit();
    }


}
