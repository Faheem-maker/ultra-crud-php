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
            </tr> <?php
                endwhile; ?>
        </tbody>
    </table>
</div>