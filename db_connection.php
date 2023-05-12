<?php

$conn = new SQLite3("/home/dog4ik/personal/php/db/database.db");
if (!$conn) {
    die("Failed ". mysqli_connect_error());
}
return $conn
?>
