<?php include '../header.php'?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body>
    <h2>Login</h2>
    <?php if (isset($_SESSION['errMsg'])): ?>
    <h3 class="alert alert-danger">
        <?php echo $_SESSION['errMsg'];
        unset($_SESSION['errMsg']) ?>
    </h3>
    <?php endif; ?>
    <form method="post" action="/login/login.php">
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" /><br /><br />
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" /><br /><br />
      <button type="submit">Login</button>
    </form>
  </body>
</html>
