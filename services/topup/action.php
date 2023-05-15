<?php
/**
 * @var PDO $conn The database connection
 */
require_once("../../db_connection.php");
session_start();
if ($_POST) {
    if (!$_SESSION['user_id']) {
        header("Location: /");
        exit();
    }
    $amount_str = $_POST['amount'];
    $my_id = $_SESSION['user_id'];
    try {
        if ((int)$amount_str<=0) {
            throw new InvalidArgumentException("Amount is incorrect");
        }
        $amount = (int)$amount_str;
        $transaction_query = $conn->prepare("UPDATE balance SET amount = amount + :amount WHERE user_id = :target_user_id");
        $transaction_query->bindParam(":amount", $amount);
        $transaction_query->bindParam(":target_user_id", $my_id);
        $res = $transaction_query->execute();
        if ($res===false) {
            $_SESSION['errMsg'] = "Failed to add funds";
        } else {
            $_SESSION['sucMsg'] = "Successfuly added $amount$";
        }
        header("Location: /services/topup");
    } catch (InvalidArgumentException $e) {
        $message = $e->getMessage();
        $_SESSION['errMsg'] = $message;
        header("Location: /services/topup");
        exit();
    }

}
