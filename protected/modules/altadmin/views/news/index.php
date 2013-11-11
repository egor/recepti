<?php
/* @var $this NewsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/news/news.js');
$this->breadcrumbs=array(
	'Новости',
);
?>
<h1>Новости<a href="/altadmin/news/add" rel="tooltip" title="добавить новость" class="btn btn-primary" style="float: right;"><i class="icon-plus"></i> добавить новость</a></h1>

<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="краткий заголовок" rel=""><i class="icon-text-width"></i></a></td>
        <td><a rel="tooltip" title="дата"><i class="icon-calendar"></i></a></td>
        <td><a rel="tooltip" title="картинка"><i class="icon-picture"></i></a></td>
        <td><a rel="tooltip" title="виводить"><i class="icon-eye-open"></i></a></td>
        <td><a rel="tooltip" title="выводить на главную"><i class="icon-globe"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->news_id.'">
        <td>'.$value->menu_name.'</td>
        <td>'.date('d.m.Y',$value->date).'</td>
        <td>'.(!empty($value->img) ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->visibility == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td>'.($value->in_main == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>
        <td><nobr>
        <a href="/altadmin/news/edit/'.$value->news_id.'" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="newsDelete('.$value->news_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>
