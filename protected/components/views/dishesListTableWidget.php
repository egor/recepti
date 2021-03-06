<?php
$i = 0;
foreach ($modelList as $value) {
    $i++;
    if ($i == 1) {
        echo '<ul class="thumbnails">';        
    }
    if (!empty($value->img) && file_exists(Yii::getPathOfAlias('webroot').'/images/dishes/'.$value->img)) {
        $img = '<img alt="'.$value->img_alt.'" title="'.$value->img_title.'" src="/images/dishes/'.$value->img.'">';
    } else {
        $img = '<img src="/images/nf.jpg">';
    }
    //var_dump($value->complexity); die;
    $url = '/recipes/'.$value->category->url.'/'.$value->url;
    if (isset($value->dishes_rating->plus) || isset($value->dishes_rating->minus)) {
        $rating = $value->dishes_rating->plus - $value->dishes_rating->minus;
    } else {
        $rating = 0;    
    }
    //$rating = (empty($rating)?0:$rating);
    $visits = (empty($value->dishes_visits->count)?0:$value->dishes_visits->count);
    echo '              <li class="span4">
                <div class="thumbnail">
                  <a href="'.$url.'">'.$img.'</a>
                  <div class="caption">
                    <div class="norm-height"><h4>'.$value->menu_name.'</h4></div>
                        '.$value->short_text.'
                            <table style="width:100%">
                            <tr>
                            <td><a rel="tooltip" title="время приготовления"><i class="icon-time"></i></a> <small>'.$value->cooking_time.' мин.</small></td>
                            <td><a rel="tooltip" title="сложность приготовления"><i class="icon-leaf"></i></a> <small>'.$value->complexity->name.'</small></td>
                            <td><a rel="tooltip" title="количество комментариев"><i class="icon-comment"></i></a> <small>0</small></td>
                            <td><a rel="tooltip" title="рейтинг"><i class="icon-star"></i></a> <small>'.$rating.'</small></td>
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