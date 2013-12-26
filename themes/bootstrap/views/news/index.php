<?php
/* @var $this NewsController */
$this->breadcrumbs = array(
    'Новости',
);
?>
<h1 class="title">Новости</h1>
<?php
if ($newsList) {
    ?>    
    <ul class="media-list">
    <?php
    foreach ($newsList as $value) {
        echo '<li class="media">';
        if (!empty($value->img) && file_exists(Yii::getPathOfAlias('webroot').'/images/news/'.$value->img)) {
            $img = '<img class="img-circle" height="100px" width="100px" alt="'.$value->img_alt.'" title="'.$value->img_title.'" src="/images/news/'.$value->img.'">';
        } else {
            $img = '<img class="img-circle" height="100px" width="100px" src="/images/nf.jpg">';
        }
        $url = '/news/'.$value->url;
        echo '<a class="pull-left" href="'.$url.'">'.$img.'</a>';
        echo '<div class="media-body"><small style="float:left;"><span class="label label-info">'.date('d.m.Y', $value->date) . '</span>&nbsp;&nbsp;</small><h4 class="media-heading"><a href="'.$url.'">'.$value->menu_name.'</a></h4>';
        echo $value->short_text;
        //echo '<a href="'.$url.'" rel="tooltip" title="Прочитать новость полностью" class="btn" style="float:right;">Подробнее ...</a>';
        echo '</div>
            </li>';
    }
}
?>    
    </ul>
    <!--<a href="/news" class="btn btn-info" rel="tooltip" title="Все новости" style="float:right;">Все новости...</a>-->
    