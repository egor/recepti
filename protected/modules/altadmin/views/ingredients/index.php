<?php
/* @var $this IngredientsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/ingredients/ingredients.js');
$this->breadcrumbs=array(
	$this->breadcrumbsTitle,
);
?>
<h1><?php echo $this->pageHeader; ?><a href="/altadmin/ingredients/add" rel="tooltip" title="добавить ингредиент" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить ингредиент</a></h1>
<div class="pagination pagination-centered">
<?php
if ($paginator) {
    $this->widget('CLinkPager', array(
        'pages' => $paginator,
        'id' => '',
        'header' => '',
        'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => 'disabled',
        'nextPageLabel' => '<span>&raquo;</span>',
        'prevPageLabel' => '<span>&laquo;</span>',
        'lastPageLabel' => '<span>&raquo;&raquo;</span>',
        'firstPageLabel' => '<span>&laquo;&laquo;</span>',
        'htmlOptions' => array('class' => 'paginator'),
    ));
}
?>
</div>
<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название" rel=""><i class="icon-text-width"></i></a></td>        
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->ingredients_id.'">
        <td><a href="/altadmin/ingredients/edit/'.$value->ingredients_id.'" title="редактировать" rel="tooltip">'.$value->name.'</a></td>        
        <td><nobr>
        <a href="/altadmin/ingredients/edit/'.$value->ingredients_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="ingredientsDelete('.$value->ingredients_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>
<div class="pagination pagination-centered">
<?php
if ($paginator) {
    $this->widget('CLinkPager', array(
        'pages' => $paginator,
        'id' => '',
        'header' => '',
        'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => 'disabled',
        'nextPageLabel' => '<span>&raquo;</span>',
        'prevPageLabel' => '<span>&laquo;</span>',
        'lastPageLabel' => '<span>&raquo;&raquo;</span>',
        'firstPageLabel' => '<span>&laquo;&laquo;</span>',
        'htmlOptions' => array('class' => 'paginator'),
    ));
}
?>
</div>