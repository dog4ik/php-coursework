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
    $user_stmt = $conn->prepare("SELECT user.phone, user.name, user.second_name, balance.amount FROM user INNER JOIN balance ON user.id = balance.user_id WHERE user.id = :id");
    $user_stmt->bindParam(':id', $id);
    $res = $user_stmt->execute()->fetchArray(1);
    $user_phone = $res['phone'];
    $user_name = $res['name'];
    $user_second_name = $res['second_name'];
    $user_balance = $res['amount'];
}

?>

   <div style="gap: 3rem;" class="container mt-4 d-flex flex-wrap justify-content-around align-items-center">
        <div style="flex-basis: 40%;" class="card flex-grow-1 fs-5">
          <div class="card-body d-flex flex-wrap justify-content-around align-items-center">
            <div>
            <h5 class="card-title"><strong>Name</strong></h5>
            <p class="card-text"><?php echo "$user_name $user_second_name" ?></p>
            </div>
            <div>
            <h5 class="card-title"><strong>Phone</strong></h5>
            <p class="card-text"><?php echo "+7 $user_phone"?></p>
          </div>
          </div>
        </div>
            <div class="card p-5 d-flex flex-grow-1 justify-content-center align-items-center ">
            <h1 class="m-0"><?php echo "$$user_balance"?></h1>
    </div>
</div>
<?php include '../footer.php'?>
