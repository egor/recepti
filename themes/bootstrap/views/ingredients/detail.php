<?php
/* @var $this IngredientsController */

$this->breadcrumbs = array(
    'Ингредиенты' => '/ingredients',
    $model->header,
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<div class="span12" style="margin-left: 0px;">
    <div  class="span6" style="margin-left: 0px;">
        <a href="/images/ingredients/real/<?php echo $model->img; ?>" data-lightbox="roadtrip" ><img class="img-polaroid" src="/images/ingredients/big/<?php echo $model->img; ?>" alt="<?php echo $model->img_alt; ?>" title="<?php echo $model->img_title; ?>" /></a>
    </div>
    <?php echo $model->text; ?>
</div>