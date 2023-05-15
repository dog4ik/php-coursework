<?php include("../../header.php")?>
<?php
if (!$_SESSION['user_id']) {
    header("Location: /login");
    exit();
}
include("../../toast.php");
if ($_SESSION['sucMsg']) {
    echo create_toast("success", "Balance", $_SESSION['sucMsg']);
    unset($_SESSION['sucMsg']);
}
if ($_SESSION['errMsg']) {
    echo create_toast("error", "Failed", $_SESSION['errMsg']);
    unset($_SESSION['errMsg']);
}
?>
<div class="container">
  <form method="post" action="/services/transaction/action.php">
    <div class="form-group">
      <label for="recipient">Recipient Phone Number</label>
      <div class="input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text">+7</span>
        </div>
        <input type="text" required class="form-control" id="recipient" name="recipient" placeholder="Phone Number"
          value=<?php echo $_GET['to']?>>
      </div>
    </div>
    <div class="form-group">
      <label for="amount">Amount</label>
      <div class="input-group my-2">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input type="number" required class="form-control" id="amount" name="amount" placeholder="Enter Amount">
      </div>
    </div>
    <button type="submit" class="btn btn-primary bg-danger">Transfer</button>
  </form>
</div>
<?php include("../../footer.php")?>
