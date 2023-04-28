<div>
    <form action="insert.php?table=<?= $table ?>" method="post" id="dynamic-form">
        <?php
        $columns = mysqli_query($conn, "SELECT `COLUMN_NAME`, `DATA_TYPE`, `COLUMN_KEY`
            FROM `INFORMATION_SCHEMA`.`COLUMNS` 
            WHERE `TABLE_SCHEMA`='ultra_crud'
            AND `TABLE_NAME`= '$table';");
        while ($column = mysqli_fetch_assoc($columns)):
            if ($column['COLUMN_KEY'] == 'PRI') {
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
        ?>" name="<?= $table ?>[<?= $column['COLUMN_NAME']; ?>]" id="dynamic_input_<?= $column['COLUMN_NAME']; ?>">
        </div>
        <?php endwhile; ?>
        <div class="form-group d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function setupDynamicForm() {
        const $form = $("#dynamic-form");
        const $table = $("#dynamic-table");


        $form.submit(function submitAjaxForm(e) {
            e.preventDefault();
            const action = $form.attr("action");
            $.ajax({
                url: action,
                data: new FormData($form[0]),
                type: 'POST',
                processData: false,
                contentType: false,
            }).then(function checkResponse(res) {
                let data = JSON.parse(res);
                let tr = '<tr>';
                tr += Object.values(data).reduce(function createTableCell(html, value) {
                    return html + `<td>${value}</td>`;
                }, '');
                tr += '</tr>';
                $table.html($table.html() + tr);
            });
        });
    });
</script>