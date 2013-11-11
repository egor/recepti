<?php
/* @var $this RecipesController */

$this->breadcrumbs=array(
	'Рецепты'
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php
$i = 0;
foreach ($modelCategory as $value) {
    $i++;
    if ($i == 1) {
        echo '<ul class="thumbnails">';        
    }
    if (!empty($value->img) && file_exists(Yii::getPathOfAlias('webroot').'/images/category/'.$value->img)) {
        $img = '<img alt="'.$value->img_alt.'" title="'.$value->img_title.'" src="/images/category/'.$value->img.'">';
    } else {
        $img = '<img src="/images/nf.jpg">';
    }
    //var_dump($value->complexity); die;
    $url = '/recipes/'.$value->url;
    
    $visits = 0;
    
    echo '              <li class="span4">
                <div class="thumbnail">
                  <a href="'.$url.'">'.$img.'</a>
                  <div class="caption">
                    <div class="norm-height"><h4>'.$value->menu_name.'</h4></div>
                        '.$value->short_text.'
                            <table style="width:100%">
                            <tr>
                            <td><a rel="tooltip" title="просмотров"><i class="icon-eye-open"></i></a> <small>'.$visits.'</small></td>
                            </tr>
                            </table>
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
/*
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
}*/
?>
</div>
