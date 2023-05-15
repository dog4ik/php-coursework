<?php

$conn = new SQLite3("./db/database.db");
if (!$conn) {
    die("Failed ". mysqli_connect_error());
}
$conn->query('CREATE TABLE user (
        id TEXT PRIMARY KEY UNIQUE,
        password TEXT NOT NULL,
        name TEXT NOT NULL,
        second_name TEXT NOT NULL,
        phone INT NOT NULL UNIQUE
);');
$conn->query('CREATE TABLE balance (
        id TEXT NOT NULL PRIMARY KEY UNIQUE,
        user_id INTEGER NOT NULL UNIQUE,
        amount REAL NOT NULL DEFAULT 0,
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);');
$conn->query('CREATE TABLE contact (
        id INTEGER AUTOINCREMENT PRIMARY KEY,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        message TEXT NOT NULL
);');
$conn->query('CREATE TABLE stock (
        id TEXT NOT NULL PRIMARY KEY UNIQUE,
        name TEXT NOT NULL UNIQUE,
        price DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);');
$conn->query('CREATE TABLE stock_owner (
        id TEXT NOT NULL PRIMARY KEY UNIQUE,
        user_id TEXT NOT NULL UNIQUE,
        stock_id TEXT NOT NULL,
        amount DECIMAL(10,2) NOT NULL DEFAULT 0,
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
        FOREIGN KEY (stock_id) REFERENCES stock(id) ON DELETE CASCADE
);');
