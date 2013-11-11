<?php
//echo Yii::app()->assetManager->baseUrl; die;
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/user/user.js');
/* @var $this UserController */
$this->breadcrumbs = array(
    'Пользователи' => '/altadmin/user',
    'Лог действий ('.$user->name.')'
);
?>
<h1>Пользователи</h1>
<p><small>Статус логера: 
<?php 
if (Yii::app()->params['loger']) { 
    echo '<span class="label label-success">Вкл</span>';    
} else {
    echo '<span class="label label-important">Выкл</span>';    
}
?></small></p>
<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="действие" rel=""><i class="icon-font"></i></a></td>
        <td><a rel="tooltip" title="врямя"><i class="icon-time"></i></a></td>
        <td><a rel="tooltip" title="данные"><i class="icon-list-alt"></i></a></td>
        <td><a rel="tooltip" title="статус"><i class="icon-flag"></i></a></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr '.($value->error == 1? ' class="error" ':'').'>
        <td>'.$value->action.'</td>
        <td><small>'.date('d.m.Y H:i:s',$value->date).'</small></td>
        <td><small>';
    $arr = (json_decode($value->array));
    foreach ($arr as $d => $key) {
        echo $d.': '.$key.'<br>';
    }
    echo '</small></td>
        <td>'.($value->error == 1?'<a rel="tooltip" title="ошибка"><i class="icon-ban-circle"></i></a>':'<a rel="tooltip" title="успех"><i class="icon-ok-circle"></i></a>').'</td>
        </tr>';
}
?>
</table>
