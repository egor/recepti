<?php

if (!empty($model)) {
    $countModel = count($model);
    $c = 0;
    echo '<a rel="tooltip" title="теги"><i class="icon-tag"></i></a> ';
    foreach ($model as $value) {
        $c++;
        echo '<a href="/tags/recipes/' . $value->tag->tag_id . '">' . $value->tag->name . '</a>' . ($c < $countModel ? ', ' : '');
    }
    echo '<br />';
}