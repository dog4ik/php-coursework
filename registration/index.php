<?php include '../header.php'?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body>
    <h2>Registration</h2>
    <?php if (isset($_GET['error'])): ?>
    <h3 class="alert alert-danger">
        <?php echo $_GET['error']; ?>
    </h3>
    <?php endif; ?>
    <form method="post" action="/registration/registration.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" /><br /><br />
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" /><br /><br />
      <label for="repeat_password">Repeat password:</label>
      <input
        type="repeat_password"
        id="repeat_password"
        name="repeat_password"
      /><br /><br />
      <input type="submit" value="Register" />
    </form>
  </body>
</html>
