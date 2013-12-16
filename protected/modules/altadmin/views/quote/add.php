<?php
/* @var $this QuoteController */
$this->breadcrumbs = array(
    'Цитаты' => '/altadmin/quote',
    $this->breadcrumbsTitle
);
$this->widget('GetFlashesWidget');
$this->widget('AvtoIncludeClientScriptWidget');
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php $this->renderPartial('/quote/_form', array('model' => $model)); ?>