<?php
/* @var $this NewsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/dishes.js');
$this->breadcrumbs=array(
	'Рецепты',
);
?>
<h1>Рецепты<a href="/altadmin/dishes/add" rel="tooltip" title="добавить рецепт" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить рецепт</a></h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="краткий заголовок" rel=""><i class="icon-text-width"></i></a></td>
        <td><a rel="tooltip" title="категория" rel=""><i class="icon-font"></i></a></td>
        <td><a rel="tooltip" title="картинка"><i class="icon-picture"></i></a></td>
        <td><a rel="tooltip" title="виводить"><i class="icon-eye-open"></i></a></td>
        <td><a rel="tooltip" title="выводить в меню"><i class="icon-globe"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->dishes_id.'">
        <td>'.$value->menu_name.'</td>
        <td>'.$value->category->menu_name.'</td>

        <td>'.(!empty($value->img) ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->visibility == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->in_menu == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td><nobr>
        <a href="/altadmin/dishes/edit/'.$value->dishes_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="dishesDelete('.$value->dishes_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>
