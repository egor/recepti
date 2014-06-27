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
            if (file_exists(Yii::getPathOfAlias('webroot') . '/images/' . $folder . '/big/' . $value->name)) {
                echo '<img class="pimages" src="/images/' . $folder . '/big/' . $value->name . '" >';
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
                
                    
                        <a href="#"  onclick="myModalDeleteImageGallery(' . $value->$modelId . ', \'/images/' . $folder . '/small/' . $value->name . '\'); return false;" title="Удалить"><i class="icon-remove"></i></a>
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

<script>
    globImgId = 0;
    function myModalDeleteImageGallery(id, path) {
        globImgId = id;
        $('#prewImageDeleteGallery').html('<img src="'+path+'" style="with:120px;"/>');
        $('#myModalDeleteImageGallery').modal('show');
    }

</script>
<div id="myModalDeleteImageGallery" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-norm-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-trash"></i>&nbsp;&nbsp;&nbsp;Удалить?</h3>
    </div>
    <div class="modal-body">
        <div style="float: left;">Удалить изображение галереи?</div><div style="float: right;"><span id="prewImageDeleteGallery"></span></div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Нет, это была случайность</button>
        <button class="btn btn-primary" id="test" onclick="deleteImageGallery();
        return false;" data-dismiss="modal" aria-hidden="true" >Да, удалить</button>
    </div>
</div>

<!-- Сообщение о том что изображение успешно удалено -->
<div id="myModalDeleteImageGallerySuccess" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-success-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-ok"></i> Успех!</h3>
    </div>
    <div class="modal-body">
        <p>Изображение успешно удалено!</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Продолжить</button>    
    </div>
</div>

<!-- Сообщение об ошибке -->
<div id="myModalDeleteImageGalleryError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-error-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-bolt icon-animated-hand-pointer red"></i> Ошибка!</h3>
    </div>
    <div class="modal-body" id="myModalDeleteImageGalleryErrorText">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>    
    </div>
</div>