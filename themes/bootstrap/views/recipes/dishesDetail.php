<?php
/* @var $this RecipesController */

$this->breadcrumbs = array(
    'Рецепты' => '/recipes',
    $modelCategory->menu_name => '/recipes/' . $modelCategory->url,
    $model->menu_name,
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<br/>

<h4>Ингридиенты</h4>
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
echo $model->text;
?>
<a rel="tooltip" title="теги"><i class="icon-tag"></i></a> <?php echo $model->tags; ?><br />
<a rel="tooltip" title="количество комментариев"><i class="icon-comment"></i></a> <small>0</small>&nbsp;
<a rel="tooltip" title="сложность"><i class="icon-leaf"></i></a> <small><?php echo $model->complexity->name; ?></small>&nbsp;
<a rel="tooltip" title="просмотров"><i class="icon-eye-open"></i></a> <small><?php echo $visits; ?></small>&nbsp;
<a rel="tooltip" title="автор"><i class="icon-user"></i></a> <small>Администратор</small>&nbsp;
<a onclick="rating(<?php echo $model->dishes_id; ?>, 'up' ); return false;" class="rating-m" rel="tooltip" title="рейтинг. понравился рецепт (+1)"><i class="icon-arrow-up"></i></a> <small id="rating-count"><?php echo ($model->dishes_rating->plus - $model->dishes_rating->minus); ?></small> <a onclick="rating(<?php echo $model->dishes_id; ?>, 'down'); return false;" class="rating-m" rel="tooltip" title="рейтинг. не понравился рецепт (-1)" ><i class="icon-arrow-down"></i></a>&nbsp; 
<a rel="tooltip" title="время приготовления"><i class="icon-time"></i></a> <small><?php echo $model->cooking_time; ?> мин.</small>&nbsp;
<br/>

<h4>Комментарии</h4>


<script>
    function rating(id, type) {        
        $.ajax({
            type: "POST",
            url: "/recipes/dishesRating",
            data: "id=" + id + "&type=" + type,                
            success: function(data){
                var obj = $.parseJSON(data);
                if (obj.error == 0) {                    
                    $('#rating-count').html(obj.rating);
                    $(".rating-m").removeClass('rating-m')
                    //class="rating-m"
                } else {
                    if (obj.message != '') {
                        alert (obj.message);
                    } else {
                        alert ('упс..... ошибочка');
                    }
                }
            }
        });
        return false;
    }
</script>