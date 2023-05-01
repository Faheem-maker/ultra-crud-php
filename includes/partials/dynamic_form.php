<?php
if (!empty($_GET['update_id'])) {
    $update_id = $_GET['update_id'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM `$table` WHERE `id` = ?");
    $stmt->bind_param('s', $update_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $update_record = mysqli_fetch_assoc($result);
}
?>

<div>
    <form action="<?= empty($update_record) ? 'insert' : 'update' ?>.php?table=<?=$table ?>" method="post">
        <?php
        $columns = mysqli_query($conn, "SELECT `COLUMN_NAME`, `DATA_TYPE`, `COLUMN_KEY`
            FROM `INFORMATION_SCHEMA`.`COLUMNS`
            WHERE `TABLE_SCHEMA`='ultra_crud'
            AND `TABLE_NAME`= '$table';");
        while ($column = mysqli_fetch_assoc($columns)):
            if ($column['COLUMN_KEY'] == 'PRI' && empty($update_record)) {
                continue;
            }
        ?>
        <div class="form-group">
        <label for="dynamic_input_<?= $column['COLUMN_NAME']; ?>"><?= $column['COLUMN_NAME']; ?></label>
        <input class="form-control" type="<?php
        switch ($column['DATA_TYPE']) {
            case 'int':
                echo 'number';
                break;
            case 'datetime':
                echo 'datetime-local';
                break;
            default:
            echo 'text';
        }
        ?>" 
        name="<?= $table ?>[<?= $column['COLUMN_NAME']; ?>]"
        id="dynamic_input_<?= $column['COLUMN_NAME']; ?>"
        value="<?= $update_record[$column['COLUMN_NAME']] ?? '' ?>"
        <?= $column['COLUMN_KEY'] == 'PRI' ? 'readonly' : '' ?>>

        </div>
        <?php endwhile; ?>
        <div class="form-group d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>