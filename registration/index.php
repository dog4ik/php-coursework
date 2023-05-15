<?php include '../header.php'?>
  <?php if (isset($_SESSION['errMsg'])): ?>
  <h3 class="alert alert-danger">
    <?php echo $_SESSION['errMsg'];
      unset($_SESSION['errMsg']); ?>
  </h3>
  <?php endif; ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card bg-black text-white border">
          <div class="card-body">
            <h3 class="text-center mb-4">Registration</h3>
            <form method="post" action="/registration/registration.php">
              <div class="form-group mb-3">
                <label for="phone">Phone Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">+7</span>
                  </div>
                <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter phone number" required>
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="name" name="name" class="form-control" id="name" placeholder="Enter first name" required>
              </div>
              <div class="form-group mb-3">
                <label for="second_name">Second name</label>
                <input type="second name" name="second_name" class="form-control" id="second_name" placeholder="Enter second name" required>
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
              </div>
              <div class="form-group mb-3">
                <label for="repeat_password">Repeat password</label>
                <input type="password" name="repeat_password" class="form-control" id="repeat_password" placeholder="Repeat password" required>
              </div>
              <button type="submit" class="btn btn-primary btn-danger mb-4">Login</button>
            </form>
            <div class="text-center">
              <p>Already have an account? <a href="/login">Register</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include '../footer.php'?>
