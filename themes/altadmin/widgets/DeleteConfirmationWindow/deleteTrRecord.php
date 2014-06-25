<script>
    var deleteTrRecordTd = <?php echo $data['td']; ?>;
    var deleteTrRecordUrl = '<?php echo $data['url']; ?>';
    var deleteTrRecordId = 0;
    function myModalDeleteTrRecord(id, name) {
        deleteTrRecordId = id;
        $('#recordName').html(name);
        $('#myModalDeleteTrRecord').modal('show');
    }
    function deleteTrRecord() {
        $.ajax({
            type: "GET",
            url: deleteTrRecordUrl,
            data: "id=" + deleteTrRecordId,
            success: function(data) {
                var obj = $.parseJSON(data);
                if (obj.error == 0) {
                    $('#tr-'+deleteTrRecordId).html('<td colspan="'+deleteTrRecordTd+'" class="recordDelete">запись удалена</td>');
                    $('#tr-'+deleteTrRecordId).hide(3500);
                    $('#myModalDeleteTrRecordSuccess').modal('show');
                } else {
                    $('#myModalDeleteTrRecordError').modal('show');
                    $('#myModalDeleteTrRecordErrorText').html(obj.message);
                }
            },
            error: function() {
                $('#myModalDeleteTrRecordError').modal('show');
                $('#myModalDeleteTrRecordErrorText').html('Неизвестная ошибка :(');
            }
        });
        $('#myModalDeleteTrRecord').hide();
        return false;
    }
</script>    
<div id="myModalDeleteTrRecord" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-norm-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-trash icon-animated-hand-pointer blue"></i>&nbsp;&nbsp;&nbsp;Удалить?</h3>
    </div>
    <div class="modal-body">
        <div style="float: left;"><?php echo $data['body']; ?></div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Нет, это была случайность</button>
        <button class="btn btn-primary" id="test" onclick="deleteTrRecord();
        return false;" data-dismiss="modal" aria-hidden="true" >Да, удалить</button>
    </div>
</div>

<!-- Сообщение о том что изображение успешно удалено -->
<div id="myModalDeleteTrRecordSuccess" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-success-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-ok icon-animated-hand-pointer green"></i> Успех!</h3>
    </div>
    <div class="modal-body">
        <p>Запись успешно удалена!</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Продолжить</button>    
    </div>
</div>

<!-- Сообщение об ошибке -->
<div id="myModalDeleteTrRecordError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-error-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-bolt icon-animated-hand-pointer red"></i> Ошибка!</h3>
    </div>
    <div class="modal-body" id="myModalDeleteTrRecordErrorText">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>    
    </div>
</div>