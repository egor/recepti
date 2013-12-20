<h2 class="dishes">Похожие рецепты</h2>
<?php
$i = 0;
echo '<ul class="thumbnails">';
foreach ($model as $value) {
    $i++;

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


        $img = '<img '.$meta.' src="/images/dishes/' . $value->img . '">';
    } else {
        $img = '<img src="/images/nf.jpg">';
    }
    $url = '/recipes/' . $value->category->url . '/' . $value->url;
    if (isset($value->dishes_rating->plus) || isset($value->dishes_rating->minus)) {
        $rating = $value->dishes_rating->plus - $value->dishes_rating->minus;
    } else {
        $rating = 0;
    }
    $visits = (empty($value->dishes_visits->count) ? 0 : $value->dishes_visits->count);
    echo '<li class="span3 ' . ($i % 4 == 0 ? 'popover-left' : 'popover-right') . '" 
        data-content="';
    $this->widget('CompositionListWidget', array('dishesId' => $value->dishes_id));
    echo '" 
        rel="popover" 
        data-original-title="<b>Ингредиенты</b>">
                <div class="thumbnail">
                  <a href="' . $url . '">' . $img . '
                  <div class="caption">
                    <div class="norm-height"><h5>' . StringOperation::cutString($value->menu_name, 30, '...') . '</h5></div>
                  </div>
                  </a>
                </div>
              </li>';

}
echo '</ul>';