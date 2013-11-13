<h4>Галерея</h4>
<script type="text/javascript" src="/js/altadmin/images-sortable/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="/js/altadmin/images-sortable/jquery.json-2.2.min.js"></script>
<script type="text/javascript" src="/js/altadmin/images-sortable/init.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/imagesOperations.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/sortableImage.css" />
<div id="images-list-block">
    <?php
    if ($imgList) {
        echo '<ul id="sortable">';
        foreach ($imgList as $value) {
            echo '<li id="note_' . $value->$modelId . '" class="editable">
            <table width="100%" class="adm-images-form" style="text-align:left; vertical-align: top;">
            <tr><td width="310px;">
            ';
            if (file_exists(Yii::getPathOfAlias('webroot') . '/images/' . $folder . '/small/' . $value->name)) {
                echo '<img class="pimages" src="/images/' . $folder . '/small/' . $value->name . '" >';
            } else {
                echo 'Нет фото';
            }
            echo '
                </td><td>
                <label for="imageAlt_' . $value->$modelId . '" style="float:left; margin-right:10px; width:30px; ">Alt:</label>                    
                <input type="text" value="' . $value->alt . '" maxlength="255" id="imageAlt_' . $value->$modelId . '" name="imageAlt_' . $value->$modelId . '" rows="7" class="span9">
                <br />
                <label for="imageTitle_' . $value->$modelId . '" style="float:left; margin-right:10px; width:30px;">Title:</label>                    
                <input type="text" value="' . $value->title . '" maxlength="255" id="imageTitle_' . $value->$modelId . '" name="imageTitle_' . $value->$modelId . '" rows="7" class="span9">



<a href="#" style="float:right;" onclick="saveImageInfo(' . $value->$modelId . '); return false;" class="btn btn-primary">Сохранить</a>
                    </td><td width="15px;" style="vertical-align:top;">
                
                    
                        <a href="#"  onclick="deleteImage(' . $value->$modelId . '); return false;" title="Удалить"><i class="icon-remove"></i></a>
</td></tr></table>                            
</li>';
        }
        echo '</ul>';
        ?>

        <div style="text-align: right;" class="form-actions" id="images-save-sort">
            <form id="changeOrder" method="post" action="">
                <p><input class="btn btn-primary" type="submit" value="Сохранить сортировку" /></p>
            </form>
        </div>
        <?php
    } else {
        echo '<p>Нет фото</p>';
    }
    ?>
</div>