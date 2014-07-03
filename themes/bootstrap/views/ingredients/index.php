<?php
/* @var $this IngredientsController */
$this->breadcrumbs = array(
    'Ингредиенты',
);
?>
<h1 class="title">Ингредиенты</h1>
<?php
$i = 0;
foreach ($model as $value) {
    $i++;
    if ($i == 1) {
        echo '<ul class="thumbnails">';        
    }
    if (!empty($value->img) && file_exists(Yii::getPathOfAlias('webroot').'/images/ingredients/small/'.$value->img)) {
        $img = '<img alt="'.$value->img_alt.'" title="'.$value->img_title.'" src="/images/ingredients/small/'.$value->img.'">';
    } else {
        $img = '<img src="/images/nf.jpg">';
    }
    $url = '/ingredients/'.$value->url;
    echo '<li class="span4 '.($i%3 == 0 ? 'popover-left': 'popover-right').'">
                <div class="thumbnail">
                  <a href="'.$url.'">'.$img.'</a>
                  <div class="caption">
                    <div class="norm-height"><h4>'.$value->name.'</h4></div>
                    <br />        
                    <p><a class="btn" href="'.$url.'">Подробнее...</a></p>
                  </div>
                </div>
              </li>';
    if ($i%3 == 0) {
        $i=0;
        echo '</ul>';        
    }
}
?>
<br clear="all" />
<div class="pagination pagination-centered">
<?php
if ($paginator) {
$this->widget('CLinkPager', array(
    'pages' => $paginator,
    'id'=>'',
    'header'=>'',
    'selectedPageCssClass' => 'active',
    'hiddenPageCssClass' => 'disabled',
    'nextPageLabel' => '<span>&raquo;</span>',
    'prevPageLabel' => '<span>&laquo;</span>',
    'lastPageLabel'=>'<span>&raquo;&raquo;</span>',
    'firstPageLabel'=>'<span>&laquo;&laquo;</span>',
    'htmlOptions' => array('class' => 'paginator'),
    
));
}
?>
</div>    