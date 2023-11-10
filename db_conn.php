<?php
$sourceName = 'mysql:host=localhost:3307;dbname=nirvana_db;';
$username = 'root';
$password = 'admin';
$options = [];

try {
    $connection = new PDO($sourceName, $username, $password, $options);
} catch(PDOException $exception) {
    $message_failed = $exception->getMessage();
}
?>