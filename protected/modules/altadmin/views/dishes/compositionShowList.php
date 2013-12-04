<h3>Ингредиенты рецепта</h3>
<table class="table table-hover">
    <tr>
        <td><a rel="tooltip" title="название" rel=""><i class="icon-text-width"></i></a></td>
        <td><a rel="tooltip" title="ед. изм."><i class="icon-resize-small"></i></a></td>
        <td><a rel="tooltip" title="кол-во"><i class="icon-resize-full"></i></a></td>
        <td><a rel="tooltip" title="обязательный"><i class="icon-random"></i></a></td>
        <td><a rel="tooltip" title="верифицирован"><i class="icon-ok"></i></a></td>
        <td></td>
    </tr>
<?php
foreach ($model as $value) {
    echo '<tr id="tr-'.$value->composition_id.'">
        <td>'.$value->ingredients->name.'</td>
        <td>'.$value->units->name.'</td>            
        <td>'.$value->count.'</td>        
        <td>'.($value->required == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>        
        <td>'.($value->ingredients->verification == 1 ? '<a rel="tooltip" title="да"><i class="icon-ok-sign"></i></a>' : '<a rel="tooltip" title="нет"><i class="icon-minus-sign"></i></a>').'</td>        
        <td><nobr>
        <a href="#" onclick="compositionEdit('.$value->composition_id.'); return false;" title="редактировать" rel="tooltip"><i class="icon-pencil"></i></a>&nbsp;
        <a href="#" onclick="compositionDelete('.$value->composition_id.'); return false;" title="удалить" rel="tooltip"><i class="icon-remove"></i></a>
        </nobr></td>
        </tr>';
}
?>
</table>