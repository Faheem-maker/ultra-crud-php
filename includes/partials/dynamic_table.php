<div>
    <table class="table">
        <thead>
            <tr>
                <?php
                $columns = mysqli_query($conn, "SELECT `COLUMN_NAME` 
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='ultra_crud'
                        AND `TABLE_NAME`= '$table';");
                while ($column =  mysqli_fetch_assoc($columns)) : ?>
                    <th><?= $column['COLUMN_NAME']; ?></th>
                <?php endwhile; ?>
                <th></th>
            </tr>
        </thead>
        <tbody id="dynamic-table">
            <tr>
                <?php
                $records = mysqli_query($conn, "SELECT * FROM `$table`");
                while ($record = mysqli_fetch_assoc($records)) :
                    foreach ($record as $key => $value) : ?>
                        <td><?= $value; ?></td>
                    <?php
                    endforeach; ?>
                    <td class="btn-group">
                        <a
                        class="btn btn-sm btn-success"
                        href="crud.php?table=<?= $table ?>&update_id=<?= $record['id']; ?>">
                            <i class="mdi mdi-pencil"></i>
                            <p class="visually-hidden">Edit</p>
                        </a>
                        <a
                        class="btn btn-sm btn-danger"
                        href="delete.php?table=<?= $table ?>&id=<?= $record['id']; ?>">
                            <i class="mdi mdi-trash-can"></i>
                            <p class="visually-hidden">Delete</p>
                        </a>
                    </td>
            </tr> <?php
                endwhile; ?>
        </tbody>
    </table>
</div>