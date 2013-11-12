<?php
/* @var $this NewsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/dishes.js');
$this->breadcrumbs=array(	
    $this->breadcrumbsTitle
);
?>
<h1><?php echo $this->pageHeader; ?><a href="/altadmin/dishes/add" rel="tooltip" title="добавить рецепт" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить рецепт</a></h1>
<div class="btn-group">
    <a href="/altadmin/dishes?category=-1" class="btn <?php echo (!Yii::app()->session['dishesCategory'] ? ' active' : '') ?>">Все</a>
    <?php
    foreach ($modelCategory as $valueCategory) {
        echo '<a href="/altadmin/dishes?category='.$valueCategory->category_id.'" class="btn ' . (Yii::app()->session['dishesCategory'] == $valueCategory->category_id ? ' active' : '') . '">'.$valueCategory->menu_name.'</a>';
    }
    ?>
</div>
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
        <td><a rel="tooltip" title="краткий заголовок" rel=""><i class="icon-text-width"></i></a></td>
        <td><a rel="tooltip" title="категория" rel=""><i class="icon-font"></i></a></td>
        <td><a rel="tooltip" title="дата добавления"><i class="icon-calendar"></i></a></td>
        <td><a rel="tooltip" title="картинка"><i class="icon-picture"></i></a></td>
        <td><a rel="tooltip" title="виводить"><i class="icon-eye-open"></i></a></td>
        <td><a rel="tooltip" title="выводить в меню"><i class="icon-globe"></i></a></td>        
        <td><a rel="tooltip" title="количество комментариев"><i class="icon-comment"></i></a></td>
        <td><a rel="tooltip" title="рейтинг"><i class="icon-star"></i></a></td>
        <td><a rel="tooltip" title="количество просмотров"><i class="icon-eye-open"></i></a></td>
        <td><a rel="tooltip" title="теги"><i class="icon-tag"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->dishes_id.'">
        <td><a href="/altadmin/dishes/edit/'.$value->dishes_id.'" title="редактировать" rel="tooltip">'.$value->menu_name.'</a></td>
        <td>'.$value->category->menu_name.'</td>
        <td><small>'.date ('d.m.Y', $value->date).'</small></td>
        <td>'.(!empty($value->img) ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->visibility == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->in_menu == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>0</td>
        <td><a href="#" rel="tooltip" title="+' . $value->dishes_rating->plus . '/-' . $value->dishes_rating->minus . '">' . ($value->dishes_rating->plus - $value->dishes_rating->minus) . '</a></td>
        <td>' . ($value->dishes_visits->count ? $value->dishes_visits->count : 0) . '</td>
        <td>'.($value->tags ? '<a rel="tooltip" title="есть"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td><nobr>
        <a href="/altadmin/dishes/edit/'.$value->dishes_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="dishesDelete('.$value->dishes_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        <a rel="tooltip" target="_blank" title="посмотреть на сайте" href="/recipes/'.$value->category->url.'/'.$value->url.'"><i class="icon-chevron-right"></i></a>
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