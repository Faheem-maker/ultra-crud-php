<?php
require_once __DIR__ . '/includes/db.php';
$table = $_GET['table'];

if (!tableExists($conn, $db, $table)) {
    die('delete.php: Invalid table name');
}

$data = $_POST[$table];
$columns = getTableColumns($conn, $db, $table);

$query = 'UPDATE ' . $table . ' SET ';

$params = [];

$id = null;
// Set the number of columns
foreach($columns as $column) {
    if ($column['COLUMN_KEY'] == 'PRI') {
        $id = $column['COLUMN_NAME'];
        continue;
    }
    $column_name = $column['COLUMN_NAME'];
    $query .= "`$column_name` = ?,";
    $params[] = $data[$column_name] ?? null;
}
$query = rtrim($query, ',');
$query .= " WHERE `$id` = ?";
$params[] = $data['id'];

// Prepare and execute the statement
$stmt = mysqli_prepare($conn, $query);
$stmt->bind_param(str_repeat('s', count($params)), ...$params);
$stmt->execute();

header('Location: crud.php?table=' . $table);