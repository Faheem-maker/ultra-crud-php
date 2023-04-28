<?php

$username = 'ultra_crud';
$password = 'BkGoNZJzm5TJX9IC';
$host = 'localhost';
$db = 'ultra_crud';

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die('Failed to connect');
}