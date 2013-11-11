<?php
/* @var $this SelectionRecipesController */

$this->breadcrumbs=array(
	'Подбор рецепта',
);
$column = 3;
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.c-all').click(function() {
            if ($('.c-all').is(':checked')) {
                $('.c-checkbox').attr('checked','checked');
                alert ();
            } else {
                $('.c-checkbox').removeAttr('checked');
            }
        });
        $('.i-all').click(function() {
            if ($('.i-all').is(':checked')) {
                $('.i-checkbox').attr('checked','checked');
                alert ();
            } else {
                $('.i-checkbox').removeAttr('checked');
            }
        });
        $('.c-checkbox').click(function() {checkedC('c')});
        $('.i-checkbox').click(function() {checkedC('i')});
        checkedC('c');
        checkedC('i');
        
        function checkedC (name) {
            allCount = $('.'+name+'-checkbox').length;
            checkedCount = $('input:checked.'+name+'-checkbox').length;
            if (allCount == checkedCount) {
                $('.'+name+'-all').attr('checked','checked');
            } else {
                $('.'+name+'-all').removeAttr('checked');
            }
        }
        
        
    });
</script>
<h1>Подбор рецепта</h1>
<form action="/selection-recipes/list" method="get">

<table class="table table-hover">
<tr><td colspan="<?php echo $column; ?>"><p>Поставте галочку напротив интересующих Вас категорий.</p></td></tr>
<tr><td colspan="<?php echo $column; ?>"><label class="checkbox"><input name="" class="c-all" type="checkbox"> Выделить все категории</label></td></tr>
<?php
$i =0;
$column = 3;
foreach ($categoryList as $value) {
    $i++;
    if ($i == 0) {
        echo '<tr>';
    }
    echo '<td><label class="checkbox">
<input class="c-checkbox" name="c-'.$value->category_id.'" type="checkbox"> ' . $value->menu_name.'<br />
</label></td>
';
    if ($i == $column) {
        $i = 0;
        echo '</tr>';
    }
}
if ($i != 0) {
    for ($j = $i; $j != $column; $j++) {
        echo '<td></td>';
    }
    echo '</tr>';
}
?>

<tr><td colspan="<?php echo $column; ?>"><p>Поставте галочку напротив имеющихся у Вас продуктов.</p></td></tr>
<tr><td colspan="<?php echo $column; ?>"><label class="checkbox"><input name="" class="i-all" type="checkbox"> Выделить все ингредиенты</label></td></tr>
<?php
$i =0;
foreach ($ingredientsList as $value) {
    $i++;
    if ($i == 0) {
        echo '<tr>';
    }
    echo '<td><label class="checkbox">
<input class="i-checkbox" name="'.$value->ingredients_id.'" type="checkbox"> ' . $value->name.'<br />
</label></td>
';
    if ($i == $column) {
        $i = 0;
        echo '</tr>';
    }
}
if ($i != 0) {
    for ($j = $i; $j != $column; $j++) {
        echo '<td></td>';
    }
    echo '</tr>';
}
?>
    <tr><td colspan="<?php echo $column; ?>"><input style="float: right;" type="submit" name="go" value="Подобрать" class="btn btn-large btn-primary" /></td></tr>
</table>
</form>