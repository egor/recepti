<?php
//echo Yii::app()->assetManager->baseUrl; die;
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/user/user.js');
/* @var $this UserController */
$this->breadcrumbs = array(
    'Пользователи',
);
?>
<h1>Пользователи<a href="/altadmin/user/add" rel="tooltip" title="добавить пользователя" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить пользователя</a></h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="имя" rel=""><i class="icon-user"></i></a></td>
        <td><a rel="tooltip" title="e-mail"><i class="icon-envelope" title="e-mail"></i></a></td>
        <td><a rel="tooltip" title="роль"><i class="icon-leaf" title="роль"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->user_id.'">
        <td>'.$value->name.'</td>
        <td>'.$value->email.'</td>
        <td>'.$value->role.'</td>
        <td><nobr>
        <a href="/altadmin/user/log/'.$value->user_id.'" title="посмотреть лог действий" rel="tooltip"><i class="icon-hdd"></i></a>&nbsp;
        <a href="/altadmin/user/edit/'.$value->user_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        '.(Yii::app()->user->id != $value->user_id?'<a href="#" onclick="userDelete('.$value->user_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>':'<a href="#" rel="tooltip" rel="tooltip" title="cамоудаление запрещено"><i class="icon-eye-open"></i></a>').'
        </nobr></td>
        </tr>';
}
?>
</table>
