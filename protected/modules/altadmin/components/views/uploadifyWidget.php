<h4>Загрузить картинки</h4>
<script src="/js/altadmin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/js/altadmin/uploadify/uploadify.css">
<form>
    <div id="queue"></div>
    <input id="file_upload" name="file_upload" type="file" multiple="true">
</form>

<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function() {
        $('#file_upload').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                'pid': '<?php echo $pid; ?>',
                'model': '<?php echo $model; ?>',
                'modelId': '<?php echo $modelId; ?>',
                'folder': '<?php echo $folder; ?>',
            },
            'swf': '/js/altadmin/uploadify/uploadify.swf',
            //'uploader' : '/library/admin/uploadify/uploadify.php'
            'uploader': '/altadmin/uploadify/uploadImg',
            'buttonText': 'Обзор ...',
            //'buttonClass' : 'btn-primary',
            'onUploadSuccess': function() {
                $.ajax({
                    type: "POST",
                    url: "/altadmin/uploadify/showImagesList",
                    data: "pid=<?php echo $pid; ?>&folder=<?php echo $folder; ?>&model=<?php echo $model; ?>&modelId=<?php echo $modelId; ?>",
                    success: function(data) {
                        $("#images-list").html(data);
                    }
                });
            }
        });
    });
</script>