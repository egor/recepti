<?php
/* @var $this NewsController */
$this->breadcrumbs = array(
    'Новости',
);
?>
<h1 class="title">Новости</h1>
<?php
foreach ($model as $value) {
    $url = '/news/'.$value->url;
    ?>
    <div class="post">
        <h2 class="title"><a href="<?php echo $url; ?>"><?php echo $value->menu_name; ?></a></h2>
        <p class="meta"><span class="date"><?php echo date('d.m.Y', $value->date); ?></span></p>
        <div style="clear: both;">&nbsp;</div>
        <div class="entry">
            <?php echo $value->short_text; ?>
            <p class="links"><a href="<?php echo $url; ?>" class="more">Подробнее</a></p>
        </div>
    </div>
    <?php
}
?>