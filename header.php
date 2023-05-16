<?php

$curr_dir = __DIR__;
/**
 * @var PDO $conn The database connection
 */
$conn = require_once("$curr_dir/db_connection.php");
session_start();
if ($_SESSION['user_id']) {
    $id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT name, second_name FROM user WHERE id = :id");

    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_name = $result['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="/index.css" rel="stylesheet" />
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
  crossorigin="anonymous"></script>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg fs-5 fw-bold bg-black">
    <div class="container-fluid mx-5">
      <a class="navbar-brand fs-4 text-danger" href="/">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="3em" width="3em" xmlns="http://www.w3.org/2000/svg"><path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"></path></svg>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav d-flex justify-content-around ms-auto">
          <li class="nav-item me-3 btn btn-danger">
            <a class="nav-link text-white" href="/services">Services</a>
          </li>
          <?php if (isset($user_name)): ?>
                 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $user_name ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/account">Account</a></li>
            <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
          </ul>
        </li>
          <?php else: ?>
            <li class="nav-item btn btn-light me-3"><a class="nav-link text-black" href="/login">Login</a></li>
            <li class="nav-item btn btn-light me-3"><a class="nav-link text-black" href="/registration">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
<div class="wrapper bg-black"  data-bs-theme="dark">
