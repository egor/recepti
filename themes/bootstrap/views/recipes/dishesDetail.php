<?php
/* @var $this RecipesController */

$this->breadcrumbs = array(
    'Рецепты' => '/recipes',
    $modelCategory->menu_name => '/recipes/' . $modelCategory->url,
    $model->menu_name,
);
?>
<div itemscope itemtype="http://schema.org/Recipe">
<h1 itemprop="name"><?php echo $this->pageHeader; ?></h1>
<div class="span12" style="margin-left: 0px;">
<div  class="span6" style="margin-left: 0px; padding-right: 15px;">
<?php
echo DishesGallery::mainGalleryImage($model->dishes_id, array('name'=>$model->menu_name));
$gallery = DishesGallery::listGalleryImages($model->dishes_id);
?>
</div>
    <div class="span6" style="margin-left: 0px;">
        <?php echo $model->short_text; ?>
    </div>
    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru"
 data-yashareQuickServices="gplus,yaru,vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter" style="float:right;"
></div> 
</div>

<h2 class="dishes">Ингредиенты для "<?php echo $model->menu_name; ?>"</h2>
<table class="table table-hover">
    <tr>
        <th>Название</th>
        <th>Кол-во</th>
        <th>Ед. изм.</th>
        <th>Обязательный</th>
        <th>Доп. информация</th>
    </tr>
    <?php
    foreach ($modelComposition as $value) {
        echo '<tr>
        <td>' . $value->ingredients->name . '</td>        
        <td>' . ($value->count != 0 ? $value->count : '') . '</td>
        <td>' . ($value->units->units_id != '1' ? $value->units->name : '') . '</td>            
        <td>' . ($value->required == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>') . '</td>        
        <td>' . $value->info . '</td>
        </tr>';
    }
    ?>
</table>
    <?php
    foreach ($modelComposition as $value) {
        echo '<div style="display:none" itemprop="ingredients">'.
        $value->ingredients->name . ' ' .
        ($value->count != 0 ? $value->count : '') . ' ' .
        ($value->units->units_id != '1' ? $value->units->name : '') . ' ' .
        '</div>';
    }
    ?>
<h2 class="dishes">Рецепт "<?php echo $model->menu_name; ?>"</h2>
<div itemprop="recipeInstructions">
<?php
echo $model->text;
?>
</div>
<?php
if ($model->tags) {
?>
<a rel="tooltip" title="теги"><i class="icon-tag"></i></a> <?php echo $model->tags; ?><br />
<?php
}
?>
<a rel="tooltip" title="количество комментариев"><i class="icon-comment"></i></a> <small>0</small>&nbsp;
<a rel="tooltip" title="сложность"><i class="icon-leaf"></i></a> <small><?php echo $model->complexity->name; ?></small>&nbsp;
<a rel="tooltip" title="количество порций"><i class="icon-info-sign"></i></a> <small itemprop="recipeYield"><?php echo $model->servings; ?></small>&nbsp;
<a rel="tooltip" title="просмотров"><i class="icon-eye-open"></i></a> <small><?php echo $visits; ?></small>&nbsp;
<a rel="tooltip" title="автор"><i class="icon-user"></i></a> <small><?php echo $model->user->name; ?></small>&nbsp;
<a onclick="rating(<?php echo $model->dishes_id; ?>, 'up');
        return false;" class="rating-m" rel="tooltip" title="рейтинг. понравился рецепт (+1)"><i class="icon-arrow-up"></i></a> <small id="rating-count"><?php echo ($model->dishes_rating->plus - $model->dishes_rating->minus); ?></small> <a onclick="rating(<?php echo $model->dishes_id; ?>, 'down');
        return false;" class="rating-m" rel="tooltip" title="рейтинг. не понравился рецепт (-1)" ><i class="icon-arrow-down"></i></a>&nbsp; 
<a rel="tooltip" title="время приготовления"><i class="icon-time"></i></a> <small itemprop="totalTime" content="PT<?php echo $model->cooking_time; ?>M"><?php echo $model->cooking_time; ?> мин.</small>&nbsp;
<a href="/recipes/print/<?php echo $model->dishes_id; ?>" target="_blank" rel="tooltip" alt="распечатать рецепт '<?php echo $model->menu_name; ?>'" title="распечатать рецепт '<?php echo $model->menu_name; ?>'"><i class="icon-print"></i></a>&nbsp;
</div>
<br/>

<h4>Комментарии</h4>


<script>
    function rating(id, type) {
        $.ajax({
            type: "POST",
            url: "/recipes/dishesRating",
            data: "id=" + id + "&type=" + type,
            success: function(data) {
                var obj = $.parseJSON(data);
                if (obj.error == 0) {
                    $('#rating-count').html(obj.rating);
                    $(".rating-m").removeClass('rating-m')
                    //class="rating-m"
                } else {
                    if (obj.message != '') {
                        alert(obj.message);
                    } else {
                        alert('упс..... ошибочка');
                    }
                }
            }
        });
        return false;
    }
</script>