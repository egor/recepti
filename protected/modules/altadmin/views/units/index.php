<?php
/* @var $this IngredientsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/units/units.js');
$this->breadcrumbs=array(
	'Еденицы измерения',
);
?>
<h1>Еденицы измерения<a href="/altadmin/units/add" rel="tooltip" title="добавить еденицу измерения" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить еденицу измерения</a></h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название" rel=""><i class="icon-text-width"></i></a></td>        
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->units_id.'">
        <td>'.$value->name.'</td>        
        <td><nobr>
        <a href="/altadmin/units/edit/'.$value->units_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="ingredientsDelete('.$value->units_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>
