<?php
/* @var $this IngredientsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/ingredients/ingredients.js');
$this->breadcrumbs=array(
	'Новости',
);
?>
<h1>Новости<a href="/altadmin/ingredients/add" rel="tooltip" title="добавить ингридиент" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить ингридиент</a></h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название" rel=""><i class="icon-text-width"></i></a></td>        
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->ingredients_id.'">
        <td>'.$value->name.'</td>        
        <td><nobr>
        <a href="/altadmin/ingredients/edit/'.$value->ingredients_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="ingredientsDelete('.$value->ingredients_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>
