<?php
$database_name = 'gestion_factures';
$host = 'localhost';
$db_username = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:dbname=$database_name;host=$host", $db_username, $db_password, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //  FETCH_OBJ or FETCH_ASSOC or FETCH_CLASS
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\Throwable $e) {
    echo "Error Database";
    die();
}


// $pdo = new PDO("mysql:dbname=gestion_stagiaires;host=127.0.0.1", "root", "", []);

// https://www.php.net/manual/fr/book.pdo.php
