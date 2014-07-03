<?php
/* @var $this NewsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/dishes.js');
$this->breadcrumbs=array(	
    $this->breadcrumbsTitle
);
?>
<h1><?php echo $this->pageHeader; ?><a href="/altadmin/dishes/add" rel="tooltip" title="добавить рецепт" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить рецепт</a></h1>
<div class="btn-group" style="margin-bottom: 5px;">
    <a href="#" class="btn btn-mini">Категории:</a>
    <a href="/altadmin/dishes?category=-1" class="btn btn-mini <?php echo (!Yii::app()->session['dishesCategory'] ? ' active' : '') ?>">Все</a>
    <?php
    foreach ($modelCategory as $valueCategory) {
        echo '<a href="/altadmin/dishes?category='.$valueCategory->category_id.'" class="btn btn-mini ' . (Yii::app()->session['dishesCategory'] == $valueCategory->category_id ? ' active' : '') . '">'.$valueCategory->menu_name.'</a>';
    }
    ?>
</div>
<br />
<div class="btn-group" style="margin-bottom: 5px;">
    <a href="#" class="btn btn-mini">Парсинг:</a>
    <a href="/altadmin/dishes?parser=-1" class="btn btn-mini <?php echo (!Yii::app()->session['dishesParser'] ? ' active' : '') ?>">Все</a>
    <a href="/altadmin/dishes?parser=1" class="btn btn-mini <?php echo (Yii::app()->session['dishesParser'] == 1 ? ' active' : '') ?>">Только спарсеные</a>
    <a href="/altadmin/dishes?parser=2" class="btn btn-mini <?php echo (Yii::app()->session['dishesParser'] == 2 ? ' active' : '') ?>">Только чистые</a>    
</div>
<br />
<div class="btn-group" style="margin-bottom: 5px;">
    <a href="#" class="btn btn-mini">Картинка в списке:</a>
    <a href="/altadmin/dishes?listPic=-1" class="btn btn-mini <?php echo (!Yii::app()->session['dishesListPic'] ? ' active' : '') ?>">Все</a>
    <a href="/altadmin/dishes?listPic=1" class="btn btn-mini <?php echo (Yii::app()->session['dishesListPic'] == 1 ? ' active' : '') ?>">Только c картинкой</a>
    <a href="/altadmin/dishes?listPic=2" class="btn btn-mini <?php echo (Yii::app()->session['dishesListPic'] == 2 ? ' active' : '') ?>">Только без картинки</a>    
</div>
<br />
<div class="btn-group" style="margin-bottom: 5px;">
    <a href="#" class="btn btn-mini">Выводить:</a>
    <a href="/altadmin/dishes?visibility=-1" class="btn btn-mini <?php echo (!Yii::app()->session['dishesVisibility'] ? ' active' : '') ?>">Все</a>
    <a href="/altadmin/dishes?visibility=1" class="btn btn-mini <?php echo (Yii::app()->session['dishesVisibility'] == 1 ? ' active' : '') ?>">Только выводимые</a>
    <a href="/altadmin/dishes?visibility=2" class="btn btn-mini <?php echo (Yii::app()->session['dishesVisibility'] == 2 ? ' active' : '') ?>">Только скрытые</a>    
</div>
<br />
<div class="btn-group" style="margin-bottom: 5px;">
    <a href="#" class="btn btn-mini">Показать на странице:</a>
    <a href="/altadmin/dishes?show=-1" class="btn btn-mini <?php echo (!Yii::app()->session['dishesShow'] ? ' active' : '') ?>"><?php echo $this->altAdminDishesPageSize;?></a>
    <a href="/altadmin/dishes?show=<?php echo $this->altAdminDishesPageSize + 50;?>" class="btn btn-mini <?php echo (Yii::app()->session['dishesShow'] == ($this->altAdminDishesPageSize + 50) ? ' active' : '') ?>"><?php echo $this->altAdminDishesPageSize + 50;?></a>
    <a href="/altadmin/dishes?show=<?php echo $this->altAdminDishesPageSize + 100;?>" class="btn btn-mini <?php echo (Yii::app()->session['dishesShow'] == ($this->altAdminDishesPageSize + 100) ? ' active' : '') ?>"><?php echo $this->altAdminDishesPageSize + 100;?></a>    
    <a href="/altadmin/dishes?show=100000000000000" class="btn btn-mini <?php echo (Yii::app()->session['dishesShow'] == 2 ? ' active' : '') ?>">Все</a>    
</div>
<br />
<div class="btn-group" style="margin-bottom: 5px;">
    <a href="#" class="btn btn-mini">Сортировать:</a>
    <a href="/altadmin/dishes?sort=-1" title="Название от А до Я" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == -1 ? ' active' : '') ?>"><i class="icon-text-width"></i> <i class="icon-arrow-up"></i></a>
    <a href="/altadmin/dishes?sort=1" title="Название от Я до А" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 1 ? ' active' : '') ?>"><i class="icon-text-width"></i> <i class="icon-arrow-down"></i></a>
    <a href="/altadmin/dishes?sort=2" title="Дата от большего к меньшему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 2 ? ' active' : '') ?>"><i class="icon-calendar"></i> <i class="icon-arrow-up"></i></a>
    <a href="/altadmin/dishes?sort=3" title="Дата от меньшего к большему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 3 ? ' active' : '') ?>"><i class="icon-calendar"></i> <i class="icon-arrow-down"></i></a>
    <a href="/altadmin/dishes?sort=4" title="Рейтинг от большего к меньшему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 4 ? ' active' : '') ?>"><i class="icon-star"></i> <i class="icon-arrow-up"></i></a>
    <a href="/altadmin/dishes?sort=5" title="Рейтинг от меньшего к большему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 5 ? ' active' : '') ?>"><i class="icon-star"></i> <i class="icon-arrow-down"></i></a>
    <a href="/altadmin/dishes?sort=6" title="Просмотры от большего к меньшему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 6 ? ' active' : '') ?>"><i class="icon-eye-open"></i> <i class="icon-arrow-up"></i></a>
    <a href="/altadmin/dishes?sort=7" title="Просмотры от меньшего к большему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 7 ? ' active' : '') ?>"><i class="icon-eye-open"></i> <i class="icon-arrow-down"></i></a>
    <a href="/altadmin/dishes?sort=8" title="Комментарии от большего к меньшему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 8 ? ' active' : '') ?>"><i class="icon-comment"></i> <i class="icon-arrow-up"></i></a>
    <a href="/altadmin/dishes?sort=9" title="Комментарии от меньшего к большему" class="btn btn-mini <?php echo (Yii::app()->session['dishesSort'] == 9 ? ' active' : '') ?>"><i class="icon-comment"></i> <i class="icon-arrow-down"></i></a>
    
</div>
<br />
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
        <td><a rel="tooltip" title="автор"><i class="icon-user"></i></a></td>
        <td><a rel="tooltip" title="дата добавления"><i class="icon-calendar"></i></a></td>
        <td><a rel="tooltip" title="картинка"><i class="icon-picture"></i></a></td>
        <td><a rel="tooltip" title="виводить"><i class="icon-eye-open"></i></a></td>
        <td><a rel="tooltip" title="выводить в меню"><i class="icon-globe"></i></a></td>        
        <td><a rel="tooltip" title="количество комментариев"><i class="icon-comment"></i></a></td>
        <td><a rel="tooltip" title="рейтинг"><i class="icon-star"></i></a></td>
        <td><a rel="tooltip" title="количество просмотров"><i class="icon-eye-open"></i></a></td>
        <td><a rel="tooltip" title="теги"><i class="icon-tag"></i></a></td>
        <td><a rel="tooltip" title="парсинг"><i class="icon-hdd"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->dishes_id.'">
        <td><a href="/altadmin/dishes/edit/'.$value->dishes_id.'" title="редактировать" rel="tooltip">'.$value->menu_name.'</a></td>
        <td>'.$value->category->menu_name.'</td>
        <td><small>'.$value->user->name.'</small></td>
        <td><small>'.date ('d.m.Y', $value->date).'</small></td>
        <td>'.(!empty($value->img) ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->visibility == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->in_menu == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>0</td>
        <td><a href="#" rel="tooltip" title="+' . $value->dishes_rating->plus . '/-' . $value->dishes_rating->minus . '">' . ($value->dishes_rating->plus - $value->dishes_rating->minus) . '</a></td>
        <td>' . ($value->dishes_visits->count ? $value->dishes_visits->count : 0) . '</td>
        <td>'.($value->tags ? '<a rel="tooltip" title="есть"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->parser ? '<a rel="tooltip" title="есть"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td><nobr>
        <a href="/altadmin/dishes/edit/'.$value->dishes_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="myModalDeleteTrRecord('.$value->dishes_id.', \''.$value->menu_name.'\'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
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
<?php
$this->widget('application.modules.altadmin.widgets.DeleteConfirmationWindow', array('method' => 'deleteTrRecord', 'data'=>array('url'=>'/altadmin/dishes/delete', 'body'=>'<p>Вы уверены что хотите удалить рецепт <b>"<span id="recordName"></span>"</b>?</p>', 'td' => 13)));