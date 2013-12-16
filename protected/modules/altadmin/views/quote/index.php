<?php
$this->breadcrumbs=array(
	$this->breadcrumbsTitle,
);
$this->widget('GetFlashesWidget');
$this->widget('AvtoIncludeClientScriptWidget');
?>
<h1><?php echo $this->pageHeader; ?><a href="/altadmin/quote/add" rel="tooltip" title="добавить цитату" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить цитату</a></h1>
<?php
if ($model) {
?>
<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="кратко" rel=""><i class="icon-text-width"></i></a></td>
        <td><a rel="tooltip" title="автор"><i class="icon-calendar"></i></a></td>
        <td><a rel="tooltip" title="виводить"><i class="icon-eye-open"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->quote_id.'">
        <td>'.$value->text.'</td>
        <td>'.$value->author.'</td>
        <td>'.($value->visibility == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td><nobr>
        <a href="/altadmin/quote/edit/'.$value->quote_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="delete('.$value->quote_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>
<?php
} else {
?>
<p>Пусто :(</p>
<?php
}
?>

