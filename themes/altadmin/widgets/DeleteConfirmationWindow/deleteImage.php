<script>
    var <?php echo $data['prefix']; ?>deleteImageId = <?php echo $data['id']; ?>;
    var <?php echo $data['prefix']; ?>deleteImageUrl = '<?php echo $data['url']; ?>';
    var <?php echo $data['prefix']; ?>deleteImagePathToImage = '<?php echo $data['pathToImage']; ?>';
    function <?php echo $data['prefix']; ?>myModalDeleteImage() {
        $('#<?php echo $data['prefix']; ?>myModalDeleteImage').modal('show');
    }
    function deleteImage() {
        $.ajax({
            type: "GET",
            url: <?php echo $data['prefix']; ?>deleteImageUrl,
            data: "id=" + <?php echo $data['prefix']; ?>deleteImageId,
            success: function(data) {
                var obj = $.parseJSON(data);
                if (obj.error == 0) {
                    $("#<?php echo $data['prefix']; ?>image-preview").html('<div class="image-preview-empty">нет фото</div>');
                    $("#<?php echo $data['prefix']; ?>image-alt").val('')
                    $("#<?php echo $data['prefix']; ?>image-title").val('');
                    $('#<?php echo $data['prefix']; ?>myModalDeleteImageSuccess').modal('show');
                } else {
                    $('#<?php echo $data['prefix']; ?>myModalDeleteImageError').modal('show');
                    $('#<?php echo $data['prefix']; ?>myModalDeleteImageErrorText').html(obj.message);
                }
            },
            error: function() {
                $('#<?php echo $data['prefix']; ?>myModalDeleteImageError').modal('show');
                $('#<?php echo $data['prefix']; ?>myModalDeleteImageErrorText').html('Неизвестная ошибка :(');
            }
        });
        $('#<?php echo $data['prefix']; ?>myModalDeleteImage').hide();
        return false;
    }
</script>    
<div id="<?php echo $data['prefix']; ?>myModalDeleteImage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-norm-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-trash"></i>&nbsp;&nbsp;&nbsp;Удалить?</h3>
    </div>
    <div class="modal-body">
        <div style="float: left;"><?php echo $data['body']; ?></div><div style="float: right;"><img src="<?php echo $data['pathToImage']; ?>" width="120px" /></div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Нет, это была случайность</button>
        <button class="btn btn-primary" id="test" onclick="deleteImage();
        return false;" data-dismiss="modal" aria-hidden="true" >Да, удалить</button>
    </div>
</div>

<!-- Сообщение о том что изображение успешно удалено -->
<div id="<?php echo $data['prefix']; ?>myModalDeleteImageSuccess" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<div id="<?php echo $data['prefix']; ?>myModalDeleteImageError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-error-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-bolt icon-animated-hand-pointer red"></i> Ошибка!</h3>
    </div>
    <div class="modal-body" id="<?php echo $data['prefix']; ?>myModalDeleteImageErrorText">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>    
    </div>
</div>