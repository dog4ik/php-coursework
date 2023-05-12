<?php

/**
 * @var SQLite3 $conn The database connection
 */
$conn = require_once("/home/dog4ik/personal/php/db_connection.php");
session_start();
if ($_SESSION['user_id']) {
    $id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT name, second_name FROM user WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute()->fetchArray(1);
    $user_name = $result['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="./index.css" rel="stylesheet" />
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
  crossorigin="anonymous"></script>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-gray">
    <div class="container-fluid mx-5">
      <a class="navbar-brand text-danger font-weight-bold" href="/">Bank</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-danger" href="/services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="contact">Contact</a>
          </li>
          <?php if (isset($user_name)): ?>
            <li class="nav-item">
              <a class="nav-link text-danger" href="/account"><?php echo $user_name ?></a></li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="/logout.php">Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link text-danger" href="/login">Login</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="/registration">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
<div class="wrapper">
