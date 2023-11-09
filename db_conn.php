<?php
$sourceName = 'mysql:host=localhost:3306;dbname=nirvana_db;';
$username = 'root';
$password = '';
$options = [];

try {
    $connection = new PDO($sourceName, $username, $password, $options);
} catch(PDOException $exception) {
    $message_failed = $exception->getMessage();
}
?>