<table class='table table-bordered table-striped table-condensed'>
<?php
foreach ($model as $value) {
    echo '<tr><td>'.$value->ingredients->name .'</td><td>'. ($value->count != 0 ? $value->count : ''). '</td><td>' . ($value->units->units_id != '1' && $value->units->units_id != '11' ? $value->units->name : '') . '</td></tr>';
}
?>
</table>