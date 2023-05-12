<?php include '../header.php'?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
require_once("../db_connection.php");
if ($_SESSION['user_id']) {
    $id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT phone, name FROM user WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $res = $stmt->execute()->fetchArray(1);
    $user_phone = $res['phone'];
    $user_name = $res['name'];
}

?>

    <h1>Account</h1>
    <div>
<?php echo $user_name ?>
<?php echo $user_phone ?>
</div>
<?php include '../footer.php'?>
