<?php
require_once __DIR__ . '/includes/db.php';
$table = $_GET['table'];

$data = $_POST[$table];


$query = 'INSERT INTO ' . $table . ' SET ';

// Set the number of columns
foreach($data as $column => $value) {
    $query .= "`$column` = '$value',";
}
$query = rtrim($query, ',');
mysqli_query($conn, $query);

// Get the last inserted id
$last_id = mysqli_insert_id($conn);

echo json_encode([$last_id, ...$data]);