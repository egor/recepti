<?php
/* @var $this RecipesController */
?>
<h1><?php echo $this->pageHeader; ?> | <?php echo Yii::app()->name; ?></h1>
<h4>Категория: <?php echo $modelCategory->menu_name; ?></h4>
<h4>Ингредиенты для "<?php echo $model->menu_name; ?>"</h4>
<table class="table table-hover">
    <tr>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Ед. изм.</th>
        <th>Обязательный</th>
        <th>Доп. информация</th>
    </tr>
    <?php
    foreach ($modelComposition as $value) {
        echo '<tr>
        <td>' . $value->ingredients->name . '</td>        
        <td>' . ($value->count != 0 ? $value->count : '') . '</td>
        <td>' . ($value->units->units_id != '1' ? $value->units->name : '') . '</td>            
        <td>' . ($value->required == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>') . '</td>        
        <td>' . $value->info . '</td>
        </tr>';
    }
    ?>
</table>
<h4>Рецепт "<?php echo $model->menu_name; ?>"</h4>
<?php
echo $model->text;
?>
<a rel="tooltip" title="сложность"><i class="icon-leaf"></i></a> <small><?php echo $model->complexity->name; ?></small>&nbsp;
<a rel="tooltip" title="время приготовления"><i class="icon-time"></i></a> <small><?php echo $model->cooking_time; ?> мин.</small>&nbsp;