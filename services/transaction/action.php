<?php


/**
 * @var PDO $conn The database connection
 */
$conn = require_once("../../db_connection.php");
session_start();
if ($_POST) {
    if (!$_SESSION['user_id']) {
        header("Location: /");
        exit();
    }
    $amount_str = $_POST['amount'];
    $recipient = $_POST['recipient'];
    $my_id = $_SESSION['user_id'];
    $regex = "/^(\s|\()?\d{3}(\s|\))?\d{3}(-|\s)?\d{2}(-|\s)?\d{2}$/";
    try {
        if(!preg_match($regex, $recipient)) {
            throw new InvalidArgumentException("Invalid phone number");
        }
        $phone = (int)preg_replace("/[^0-9]/", "", $recipient);
        $my_balance_query = $conn->prepare("SELECT amount FROM balance WHERE user_id = :my_id");
        $my_balance_query->bindParam("my_id", $my_id);
        $my_balance_query->execute();
        $my_balance = $my_balance_query->fetch(PDO::FETCH_ASSOC);
        $my_balance_amount = (int)$my_balance['amount'];
        if ((int)$amount_str<=0) {
            throw new InvalidArgumentException("Amount is incorrect");
        }
        $amount = (int)$amount_str;
        if ($my_balance_amount<$amount) {
            throw new InvalidArgumentException("Insufficient funds");
        }

        $usr_query = $conn->prepare("SELECT id FROM user WHERE phone = :phone");
        $usr_query->bindParam(":phone", $phone);
        $usr_query->execute();
        $user = $usr_query->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $target_user_id = $user['id'];
            if ($target_user_id === $my_id) {
                throw new InvalidArgumentException("Cant send money to yourself");
            }
            $transaction_query = $conn->prepare("UPDATE balance SET amount = amount + :amount WHERE user_id = :target_user_id");
            $my_transaction_query = $conn->prepare("UPDATE balance SET amount = amount - :amount WHERE user_id = :target_user_id");
            $transaction_query->bindParam(":amount", $amount);
            $transaction_query->bindParam(":target_user_id", $target_user_id);
            $my_transaction_query->bindParam(":amount", $amount);
            $my_transaction_query->bindParam(":target_user_id", $my_id);
            $his_res = $transaction_query->execute();
            $my_res = $my_transaction_query->execute();
            if($his_res===false or $my_res===false) {
                //FIX: money disappear
                throw new InvalidArgumentException("Transaction failed");
            } else {
                $_SESSION['sucMsg'] = "Transaction successful";
            }
            header("Location: /services/transaction");
        } else {
            throw new InvalidArgumentException("Requested user is not found");
        }
    } catch (InvalidArgumentException $e) {
        $message = $e->getMessage();
        $_SESSION['errMsg'] = $message;
        header("Location: /services/transaction?to=$recipient");
        exit();
    }

}
