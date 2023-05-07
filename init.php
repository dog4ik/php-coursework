<?php

$conn = new SQLite3("./db/database.db");
if (!$conn) {
    die("Failed ". mysqli_connect_error());
}
$conn->query('CREATE TABLE user (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        password TEXT NOT NULL,
        login TEXT NOT NULL UNIQUE
);');
