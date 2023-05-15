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
            <h3 class="text-center mb-4">Topup</h3>
            <form method="post" action="/services/topup/action.php">
              <div class="form-group mb-3">
                <label for="amount">Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" required>
                </div>
              </div>
              <div class="d-flex">
              <button type="submit" class="btn btn-primary btn-danger mb-4">Topup</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include("../../footer.php")?>
