<script>
    var deleteMassRecordUrl = '<?php echo $data['url']; ?>';
    function myModalDeleteMassRecord() {
        $('#myModalDeleteMassRecord').modal('show');
    }
    function deleteMassRecord() {
        formData = $("#formTable").serialize();
        $.ajax({
            type: "POST",
            url: deleteMassRecordUrl,
            data: formData,
            success: function(data) {
                var obj = $.parseJSON(data);
                if (obj.error == 0) {
                    //location.reload('/?massRecordSuccess');
                    document.location.href = '?massRecordSuccess';
                    //$('#myModalDeleteMassRecordSuccess').modal('show');
                    //CMSContent
                } else {
                    $('#myModalDeleteMassRecordError').modal('show');
                    $('#myModalDeleteMassRecordErrorText').html(obj.message);
                }
            },
            error: function() {
                $('#myModalDeleteMassRecordError').modal('show');
                $('#myModalDeleteMassRecordErrorText').html('Неизвестная ошибка :(');
            }
        });
        $('#myModalDeleteMassRecord').hide();
        return false;               
    }
    
    $(document).ready(function () {
        <?php if (isset($_GET['massRecordSuccess'])) { ?>
            $('#myModalDeleteMassRecordSuccess').modal('show');
        <?php } ?>                
    });
</script>    
<div id="myModalDeleteMassRecord" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-norm-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-trash icon-animated-hand-pointer blue"></i>&nbsp;&nbsp;&nbsp;Удалить?</h3>
    </div>
    <div class="modal-body">
        <div style="float: left;"><?php echo $data['body']; ?></div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Нет, это была случайность</button>
        <button class="btn btn-primary" id="test" onclick="deleteMassRecord();
        return false;" data-dismiss="modal" aria-hidden="true" >Да, удалить</button>
    </div>
</div>

<!-- Сообщение о том что записи успешно удалены -->
<div id="myModalDeleteMassRecordSuccess" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-success-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-ok icon-animated-hand-pointer green"></i> Успех!</h3>
    </div>
    <div class="modal-body">
        <p>Записи успешно удалены!</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Продолжить</button>    
    </div>
</div>

<!-- Сообщение об ошибке -->
<div id="myModalDeleteMassRecordError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header modal-error-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><i class="icon-bolt icon-animated-hand-pointer red"></i> Ошибка!</h3>
    </div>
    <div class="modal-body" id="myModalDeleteMassRecordErrorText">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>    
    </div>
</div>