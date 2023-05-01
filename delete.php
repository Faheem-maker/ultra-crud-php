<?php

require_once __DIR__ . '/includes/db.php';

$table_name = $_GET['table'];
$id = $_GET['id'];

// Make sure that table exists
if (!tableExists($conn, $db, $table_name)) {
    die('delete.php: Invalid table name');
}

// Run the delete query
$stmt = mysqli_prepare($conn, "DELETE FROM `$table_name` WHERE `id` = ?");
$stmt->bind_param('s', $id);
$stmt->execute();

header('Location: crud.php?table=' . $table_name);