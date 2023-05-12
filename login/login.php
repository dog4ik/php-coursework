<?php

/**
 * @var SQLite3 $conn The database connection
 */
$conn = require_once("../db_connection.php");
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /");
    exit;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_POST) {
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    //WARN: Read (https://regexlicensing.org/)
    $regex = "/^(\s|\()?\d{3}(\s|\))?\d{3}(-|\s)?\d{2}(-|\s)?\d{2}$/";

    //validate here
    try {
        // validate the form data
        $passLen = strlen($password);
        if ($passLen<8 or $passLen>40) {
            throw new InvalidArgumentException("Password should be >8 and <40 symbols");
        }
        if (!preg_match($regex, $phone)) {
            throw new InvalidArgumentException("Phone is not correct");
        }
        $stmt = $conn->prepare("SELECT phone, password, id FROM user WHERE phone = :phone");
        $phone_numbers = (int)preg_replace("/[^0-9]/", "", $phone);
        // Bind parameters
        $stmt->bindParam(':phone', $phone_numbers);
        $result = $stmt->execute()->fetchArray(1);

        if ($result) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['user_id']=$result['id'];
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
        header("Location: /login");
        $_SESSION['errMsg'] = $errorMessage;
        exit();
    }

    exit();
}
