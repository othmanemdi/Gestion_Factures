<?php
$database_name = 'gestion_factures';
$hote = 'localhost';
$db_username = 'root';
$db_password = '';

$pdo = new PDO("mysql:dbname=$database_name;host=$hote", $db_username, $db_password, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //  FETCH_OBJ or FETCH_ASSOC or FETCH_CLASS
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// ALTER TABLE `clients` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `telephone`, ADD `update_at` DATETIME NULL DEFAULT NULL AFTER `created_at`, ADD `deleted_at` DATETIME NULL DEFAULT NULL AFTER `update_at`;



//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //  FETCH_OBJ or FETCH_ASSOC or FETCH_CLASS
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION





// $pdo = new PDO("mysql:dbname=gestion_stagiaires;host=127.0.0.1", "root", "", []);







// https://www.php.net/manual/fr/book.pdo.php


// try {
//     $pdo = new PDO('mysql:dbname=media_market;host=127.0.0.1', 'root', '', [
//         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //  FETCH_OBJ or FETCH_ASSOC or FETCH_CLASS
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//     ]);
// } catch (\Throwable $e) {
//     echo "Error Database";
//     die();
// }