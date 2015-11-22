<?php // version 9 ?>


<?php if($just_updated) include($GLOBALS['env']->ENV_VARS['CENTRAL_PATH'].'templates/admin/update_success_message.tpl.php'); ?>
<form action='' enctype="multipart/form-data" id='table_form' method='POST'>
    <table>
        <tr>
            <?php
            foreach ($columns as $column) {
                echo "<th>$column";
                $special_column_type = get_special_column_type($special_columns, $column);
                if ($special_column_type == 'image') echo "<small>(click to replace)</small>";
                echo" </th>";
            }
            ?>
        </tr>
        <?php
            //$columns = array_keys($rows[0]);
            if ($rows) {
                foreach ($rows as $row) {
                    $id = $row['id'];

                    echo "<tr>";
                        foreach ($row as $column => $record) { ?>
                            <td>
                                <?php

                                $special_column_type = get_special_column_type($special_columns, $column);
                                if ($special_column_type) {
                                    switch ($special_column_type) {
                                        case 'image':
                                            echo "<input type='text' value='$record' name='column__{$column}__id__$id' class='fileinput' id='file-$column-$id' />";
                                        break;
                                        case 'text_content':
                                            echo "<input type='button' class='tiny button' VALUE='[ Upravit textový obsah ]' class='editable-content' onclick='window.open(\"{$admin->env->basedir}admin/editor/?id=$id\", \"window_name\", \"width=500,height=500\")' />";
                                        break;
                                        case 'password':
                                            echo "***********";
                                        break;
                                        case 'reference':
                                            echo "<a href='?plugin_id=". get_reference_id($special_columns, $column) . "&filter_id=$id&parent=".get_parent_name($table_name)."'>edit</a>";
                                        break;
                                        case 'select':
                                            echo "<select name='column__{$column}__id__$id'>";
                                                $select = get_column_by_name($special_columns, $column);
                                                foreach($select->options as $option) {
                                                    echo "<option value='{$option->id}' ";
                                                    if($option->id == $record) echo "selected='selected'";
                                                    echo ">{$option->val}</option>";
                                                }
                                            echo "</select>";
                                        break;
                                        default:
                                            echo "<input type='$special_column_type' name='column__{$column}__id__$id' value='$record' />";
                                        break;
                                    }
                                }
                                else
                                    echo "$record";
                                ?>
                            </td>
                            <?php
                        }
                    echo "</tr>";
                }
            }
            $id++;
            echo "<tr class='hidden' id='newline'>";
            foreach ($columns as $column) { ?>
            <?php
                $special_column_type = get_special_column_type($special_columns, $column);
                if ($special_column_type) {
                    if ($special_column_type=='image') {
                        echo "<td><input type='text' value='' name='newcol__{$column}__id__$id' placeholder='select a file...' class='fileinput' id='file-$column-$id' /></td>";
                    }
                    else if ($special_column_type == 'reference') {
                        echo "<td></td>";
                    }
                    else if ($special_column_type == 'text_content') {
                        echo "<td><textarea cols='20' rows='15' name='newcol__{$column}__id__$id'></textarea>";
                    }
                    else if ($special_column_type == 'select') {
                        echo "<td><select name='newcol__{$column}__id__$id'>";
                            $select = get_column_by_name($special_columns, $column);
                            foreach($select->options as $option) {
                                echo "<option value='{$option->id}'>{$option->val}</option>";
                            }
                        echo "</select></td>";
                    }
                    else
                    {
                        echo "<td><input type='$special_column_type' name='newcol__{$column}__id__$id' value='' /></td>";
                    }
                }
                else if ($column == "id") echo "<td>$id</td>";
                else if ($column == "{$parent}_id") {
                    echo "
                        <td>$filter_id</td>
                        <input type='hidden' name ='newcol__{$column}__id__$id' value='$filter_id' />
                    ";
                }
                else echo "<td></td>";
            }

            echo "</tr>";

            function get_special_column_type($special_columns, $column) {
                if(!$special_columns) return false;
                foreach ($special_columns as $special_column) {
                    if ($special_column->name == $column) {
                        return $special_column->type;
                    }
                }
                return false;
            }
            
            function get_reference_id($special_columns, $column) {
                foreach ($special_columns as $special_column) {
                    if ($special_column->name == $column) {
                        return $special_column->reference_id;
                    }
                }
            }
            
            function get_parent_name($table_name) {
                $parts = explode("_", $table_name);
                return $parts[1];
            }

            function get_column_by_name($special_columns, $name) {
                foreach($special_columns as $special_column) {
                    if($special_column->name == $name) return $special_column;
                }
                return false;
            }
        ?>

    </table>

    <?php if (!($disable_new_record)) { ?>
        <input type='button' class="small center button" id='add_new_button' value='Add new item' />
    <?php } ?>
    <?php if(!$disable_save) { ?>
        <input type='hidden' name='tableedit_action' value='update' />
        <input type='hidden' name='table_name' value='<?php echo $table_name; ?>'>
        <input type='submit' class="small center button" value='Save' />
    <?php } ?>
</form>

