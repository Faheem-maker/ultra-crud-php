<?php

$username = 'ultra_crud';
$password = 'BkGoNZJzm5TJX9IC';
$host = 'localhost';
$db = 'ultra_crud';

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die('Failed to connect');
}

function tableExists(mysqli $conn, string $db, string $table) {
    $query = "SELECT count(*)
    FROM information_schema.tables
    WHERE table_schema = '$db'
    AND table_name = ?";

    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param('s', $table);
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_array($result, MYSQLI_NUM)[0] > 0;
}

function getTableColumns(mysqli $conn, string $db, string $table): array {
    $stmt = mysqli_prepare($conn, "SELECT `COLUMN_NAME`, `COLUMN_KEY`
    FROM `INFORMATION_SCHEMA`.`COLUMNS`
    WHERE `TABLE_SCHEMA`='ultra_crud'
    AND `TABLE_NAME`= ?;");
    $stmt->bind_param('s', $table);
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
