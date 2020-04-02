<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$databse = 'second_home';

$dsn = 'mysql:dbname=' . $databse . ';host=' . $host . ';port=3306';
try {
    $pdocon = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die('Could not connect to the database:<br/>'.$e);
}
?>