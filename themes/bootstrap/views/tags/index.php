<?php
/* @var $this TagsController */

$this->breadcrumbs = array(
    'Теги'
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<ul>
    <?php
    foreach ($model as $value) {
        if ($value->tagDishesCount > 0) {
            echo '<li><a href="/tags/recipes/' . $value->tag_id . '" rel="tooltip" title="' . Yii::t('app', ' {n} запись| {n} записи| {n} записей', $value->tagDishesCount) . ' с тегом">' . $value->name . ' (' . $value->tagDishesCount . ')' . '</a></li>';
        } else {
            echo '<li>' . $value->name . ' (' . $value->tagDishesCount . ')' . '</li>';
        }
    }
    ?>
</ul>