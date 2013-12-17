<?php
$i = 0;
foreach ($modelList as $value) {
    $url = '/recipes/' . $value->category->url . '/' . $value->url;
    if (!empty($value->img) && file_exists(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $value->img)) {

        $meta = '';
        if ($value->img_alt) {
            $meta .= ' alt="' . $value->img_alt . '" ';
        } else {
            $meta .= ' alt="Фото, ' . $value->menu_name . '" ';
        }
        if ($value->img_title) {
            $meta .= ' title="' . $value->img_title . '" ';
        } else {
            $meta .= ' title="Фото, ' . $value->menu_name . '" ';
        }


        $img = '<img class="media-object img-polaroid" width="164px" ' . $meta . ' src="/images/dishes/' . $value->img . '">';
    } else {
        $img = '<img class="media-object img-polaroid" width="164px" src="/images/nf.jpg">';
    }
    if (isset($value->dishes_rating->plus) || isset($value->dishes_rating->minus)) {
        $rating = $value->dishes_rating->plus - $value->dishes_rating->minus;
    } else {
        $rating = 0;
    }
    $visits = (empty($value->dishes_visits->count) ? 0 : $value->dishes_visits->count);
    ?>
    <div class="media popover-left" data-content="<?php $this->widget('CompositionListWidget', array('dishesId' => $value->dishes_id)); ?>"

         rel="popover"
         data-original-title="<b>Ингредиенты</b>">
        <a class="pull-left" href="<?php echo $url; ?>">
            <?php echo $img; ?>

        </a>
        <div class="media-body">
            <a href="<?php echo $url; ?>"><h4 class="media-heading"><?php echo $value->menu_name; ?></h4></a>
            <?php echo cut_string(strip_tags($value->short_text), 120); ?>...

            <table style="width:100%">
                <tr>
                    <td style="width:20%"><a rel="tooltip" title="время приготовления"><i class="icon-time"></i></a> <small><?php echo $value->cooking_time; ?> мин.</small></td>
                    <td style="width:20%"><a rel="tooltip" title="сложность приготовления"><i class="icon-leaf"></i></a> <small><?php echo $value->complexity->name; ?></small></td>
                    <td style="width:20%"><a rel="tooltip" title="количество комментариев"><i class="icon-comment"></i></a> <small>0</small></td>
                    <td style="width:20%"><a rel="tooltip" title="рейтинг"><i class="icon-star"></i></a> <small><?php echo $rating; ?></small></td>
                    <td style="width:20%"><a rel="tooltip" title="просмотров"><i class="icon-eye-open"></i></a> <small><?php echo $visits; ?></small></td>
                </tr>
            </table>
            <p><a class="btn" style="float: right;" href="<?php echo $url; ?>">Подробнее...</a></p>

        </div>
    </div>
    <?php
}
?>

<br clear="all" />
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

function cut_string($string, $length) {
    $string = mb_substr($string, 0, $length, 'UTF-8');
    $pos = mb_strrpos($string, ' ', 'UTF-8');
    $string = mb_substr($string, 0, $pos, 'UTF-8');
    return $string;
}