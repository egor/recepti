<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Парсинг' => '/altadmin/parser',
    'Результат'
);
$this->widget('GetFlashesWidget');
?>
<h1>Результат парсинга</h1>
<?php
echo '<p>Всего обработано: '.$count.'</p>';
?>
<table class="table table-hover">
<?php
$i = 0;
foreach ($data as $value) {
    $i++;
    echo '<tr '.($value['error'] == 1? 'class="error"' : '' ).'><td><small>'.$i.'</small></td><td><small>'.$value['link'].'</small></td><td><small>'.$value['header'] .'</small></td><td><small>'.$value['info'].'</small></td></tr>';
}
?>
</table>