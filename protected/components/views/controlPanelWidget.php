    <div class="btn-group">
    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
    Отображать <i class="icon-th"></i>
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
    <li class="active"><a href=""><i class="icon-th"></i> Отобразить в виде таблицы</a></li>
    <li><a href=""><i class="icon-th-list"></i> Отобразить в виде списка</a></li>
    </ul>
    </div>

    <div class="btn-group">
    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
    Рецептов на страницу 21</i>
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
    <li class="active"><a href=""><i class="icon-th"></i> Отобразить в виде таблицы</a></li>
    <li><a href=""><i class="icon-th-list"></i> Отобразить в виде списка</a></li>
    </ul>
    </div>
<div class="btn-group">
    <button class="btn btn-mini">Отображать: </button>
    <a href="?show=table" title="Отобразить в виде таблицы" class="btn btn-mini<?php echo (Yii::app()->session['show'] == 'dishesListTableWidget' ? ' active' : ''); ?>"><i class="icon-th"></i></a>
    <a href="?show=list" title="Отобразить в виде списка" class="btn btn-mini<?php echo (Yii::app()->session['show'] == 'dishesListWidget' ? ' active' : ''); ?>"><i class="icon-th-list"></i></a>
</div>

<div class="btn-group">
    <button class="btn btn-mini">Рецептов на страницу: </button>
    <a href="?show=table" title="" class="btn btn-mini<?php echo (Yii::app()->session['show'] == 'dishesListTableWidget' ? ' active' : ''); ?>">12</a>
    <a href="?show=table" title="" class="btn btn-mini<?php echo (Yii::app()->session['show'] == 'dishesListTableWidget' ? ' active' : ''); ?>">21</a>
    <a href="?show=list" title="" class="btn btn-mini<?php echo (Yii::app()->session['show'] == 'dishesListWidget' ? ' active' : ''); ?>">30</a>
</div>

<div class="btn-group">
    <a class="btn btn-mini default" href="#">Сортировать:</a>
    <a class="btn btn-mini " title="Название от А до Я" href="/altadmin/dishes?sort=-1"><i class="icon-font"></i> <i class="icon-arrow-up"></i></a>
    <a class="btn btn-mini " title="Название от Я до А" href="/altadmin/dishes?sort=1"><i class="icon-font"></i> <i class="icon-arrow-down"></i></a>
    <!--<a class="btn btn-mini " title="Дата от большего к меньшему" href="/altadmin/dishes?sort=2"><i class="icon-calendar"></i> <i class="icon-arrow-up"></i></a>
    <a class="btn btn-mini " title="Дата от меньшего к большему" href="/altadmin/dishes?sort=3"><i class="icon-calendar"></i> <i class="icon-arrow-down"></i></a>-->
    <a class="btn btn-mini " title="Рейтинг от большего к меньшему" href="/altadmin/dishes?sort=4"><i class="icon-star"></i> <i class="icon-arrow-up"></i></a>
    <a class="btn btn-mini " title="Рейтинг от меньшего к большему" href="/altadmin/dishes?sort=5"><i class="icon-star"></i> <i class="icon-arrow-down"></i></a>
</div>
<br clear="all" />