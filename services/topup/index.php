<?php include("../../header.php")?>
<?php
if (!$_SESSION['user_id']) {
    header("Location: /login");
    exit();
}
?>
<div class="container">
  <form method="post" action="/services/topup/action.php">
    <div class="form-group">
      <?php if (isset($_SESSION['errMsg'])): ?>
      <h3 class="alert alert-danger">
        <?php echo $_SESSION['errMsg'];
      unset($_SESSION['errMsg']); ?>
      </h3>
      <?php endif; ?>
      <?php if (isset($_SESSION['sucMsg'])): ?>
      <h3 class="alert alert-success">
        <?php echo $_SESSION['sucMsg'];
      unset($_SESSION['sucMsg']); ?>
      </h3>
      <?php endif; ?>

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
    <button type="submit" class="btn btn-primary bg-danger">TopUp</button>
  </form>
</div>
<?php include("../../footer.php")?>
