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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card bg-black text-white border">
          <div class="card-body">
            <h3 class="text-center mb-4">Transaction</h3>
            <form method="post" action="/services/transaction/action.php">
              <div class="form-group mb-3">
                <label for="recipient">Phone Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">+7</span>
                  </div>
                  <input type="tel" name="recipient" value="<?php echo $_GET['to'] ?>" class="form-control" id="recipient" placeholder="Enter phone number" required>
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="amount">Amount</label>
                <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" required>
              </div>
              <div class="d-flex">
              <button type="submit" class="btn btn-primary btn-danger mb-4">Transfer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include("../../footer.php")?>
