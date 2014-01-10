<?php
/* @var $this MSearchController */

$this->breadcrumbs = array(
    'Поиск рецептов'
);
?>
<script>
    function ingredientsChecked(status) {
        $(".ingredients-checkbox").each(function() {
            $(this).attr("checked", status);
        })
    }
    function ingredientsParentChecked(status) {
        if (status == false) {
            $("#ingredientsMainChecker").attr("checked", status);
        } else {
            var isallchecked = true;
            $(".ingredients-checkbox").each(function() {
                if (!$(this).attr("checked"))
                    isallchecked = false;
            })
            if (isallchecked) {
                $("#ingredientsMainChecker").attr("checked", true);
            }
        }
    }
    function categoryChecked(status) {
        $(".category-checkbox").each(function() {
            $(this).attr("checked", status);
        })
    }
    function categoryParentChecked(status) {
        if (status == false) {
            $("#categoryMainChecker").attr("checked", status);
        } else {
            var isallchecked = true;
            $(".category-checkbox").each(function() {
                if (!$(this).attr("checked"))
                    isallchecked = false;
            })
            if (isallchecked) {
                $("#categoryMainChecker").attr("checked", true);
            }
        }
    }
    
</script>
<?php $this->widget('GetFlashesWidget'); ?>
<h1><?php echo $this->pageHeader; ?></h1>
<div class="accordion" id="accordion2">
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
Параметры поиска
</a>
</div>
<div id="collapseOne" class="accordion-body collapse <?php echo (isset($_POST['mSearchForm']) ? '' : 'in'); ?>">
<div class="accordion-inner">
<form class="form-inline" name="mSearchForm" method="POST">
    <div class="mSearchBtn">
        <a href="/mSearch" class="btn">Отмена</a>
        <button type="submit" name="mSearchForm" class="btn btn-primary">Найти рецепт</button>
    </div>
    <p>Я хочу приготовить блюдо из категории:<br /><small>(Выберите нужную категорию блюда)</small></p>
    <ul class="thumbnails" style="margin: 0; padding: 0;">
        <li style="margin: 0; padding: 0;">
            <label class="checkbox">
                <input type="checkbox" name="category-all" id="categoryMainChecker" onclick="categoryChecked(this.checked)"> Все категории
            </label>
        </li>
        <?php
        foreach ($category as $valueCategory) {
            echo '<li>
  <label class="checkbox">
    <input class="category-checkbox" onclick="categoryParentChecked(this.checked)" type="checkbox" name="category-' . $valueCategory->category_id . '" ' . (isset($_POST["category-" . $valueCategory->category_id]) ? '  checked="checked" ' : '') . ' /> ' . $valueCategory->menu_name . '
  </label>
    </li>';
        }
        ?>



    </ul>
    
    <hr />
    <p>У меня есть ингредиенты:<br />
        <small>(Выберите ингредиенты которые у Вас уже есть или будут до момента приготовления)</small></p>

    <ul class="mSearchUl">
        <li>
            <label class="checkbox">
                <input type="checkbox" id="ingredientsMainChecker" onclick="ingredientsChecked(this.checked)" name="ingredients-all"> все ингредиенты
            </label>
        </li>
        
        <?php
        $letter = '';
        foreach ($ingredients as $valueIngredients) {
            $fLetter = mb_substr($valueIngredients->name, 0, 1, 'UTF-8');
            if ($letter != $fLetter) {
                $letter = $fLetter;
                echo '<li class="sort-letter">'.$fLetter.'</li>';
            }
            echo '<li>
  <label class="checkbox">
    <input class="ingredients-checkbox" onclick="ingredientsParentChecked(this.checked)" type="checkbox" name="ingredients-' . $valueIngredients->ingredients_id . '" ' . (isset($_POST["ingredients-" . $valueIngredients->ingredients_id]) ? '  checked="checked" ' : '') . ' /> ' . $valueIngredients->name . '
  </label>
    </li>';
        }
        ?>
    </ul>
    <br clear="all" />
    <hr />    
    <p>Я могу потратить времени на приготовление:<br />
        <small>(Выберите количество времени которое Вы готовы потратить на приготовление блюда)</small></p>
    <ul class="mSearchUl">
        <li>
            <label class="radio">
                <input type="radio" name="time" value="0" <?php echo (((isset($_POST["time"]) && $_POST["time"]=='0') || !isset($_POST["time"])) ? '  checked="checked" ' : ''); ?>> Не имеет значения
            </label>
        </li>
        <li>
            <label class="radio">
                <input type="radio" name="time" value="30" <?php echo ((isset($_POST["time"]) && $_POST["time"]=='30') ? '  checked="checked" ' : ''); ?>> 30 минут
            </label>
        </li>
        <li>
            <label class="radio">
                <input type="radio" name="time" value="60" <?php echo ((isset($_POST["time"]) && $_POST["time"]=='60') ? '  checked="checked" ' : ''); ?>> 60 минут
            </label>
        </li>
        <li>
            <label class="radio">
                <input type="radio" name="time" value="120" <?php echo ((isset($_POST["time"]) && $_POST["time"]=='120') ? '  checked="checked" ' : ''); ?>> 120 минут
            </label>
        </li>
    </ul>
    <br clear="all" />
    <hr />
    <p>Рецепт должен быть:<br />
        <small>(Выберите сложность рецепта с которым Вы готовы работать)</small></p>
    <ul class="mSearchUl">
        <li>
            <label class="radio">
                <input type="radio" name="complexity" value="0" <?php echo (((isset($_POST["complexity"]) && $_POST["complexity"]=='0') || !isset($_POST["complexity"])) ? '  checked="checked" ' : ''); ?>> Не имеет значения
            </label>
        </li>
        <li>
            <label class="radio">
                <input type="radio" name="complexity" value="1" <?php echo ((isset($_POST["complexity"]) && $_POST["complexity"]=='1') ? '  checked="checked" ' : ''); ?>> Простой
            </label>
        </li><li>
            <label class="radio">
                <input type="radio" name="complexity" value="2" <?php echo ((isset($_POST["complexity"]) && $_POST["complexity"]=='2') ? '  checked="checked" ' : ''); ?>> Сложный
            </label>

        </li>
    </ul>
    <br clear="all" />
    
    <div class="mSearchBtn">
        <a href="/mSearch" class="btn">Отмена</a>
        <button type="submit" name="mSearchForm" class="btn btn-primary">Найти рецепт</button>
    </div>
</form>
</div>
</div>
</div>
</div>
<?php
if (isset($_POST['mSearchForm'])) {
    if ($modelList) {
        $this->widget('DishesListWidget', array('modelList' => $modelList, 'paginator' => $paginator, 'viewWitget' => Yii::app()->session['show'])); 
    } else {
        echo '<p>По заданным параметрам нисего не найдено.</p>';
    }
}