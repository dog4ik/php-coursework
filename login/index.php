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
    <?php if (isset($_GET['error'])): ?>
    <h3 class="alert alert-danger">
        <?php echo $_GET['error']; ?>
    </h3>
    <?php endif; ?>
    <form method="post" action="/login/login.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" /><br /><br />
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" /><br /><br />
      <input type="submit" value="Login" />
    </form>
  </body>
</html>
