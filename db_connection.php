<?php

$curr_dir = __DIR__;
$conn = new PDO("sqlite:$curr_dir/db/database.db");
if (!$conn) {
    die("Failed ". mysqli_connect_error());
}
return $conn;
