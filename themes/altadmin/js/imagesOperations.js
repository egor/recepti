function deleteImageGallery() {
    //alert (globImgId); return true;
    //if (!confirm("Уверены, что хотите удалить куртинку?")) {
    //    return true;
    //}
    $.ajax({
        type: "GET",
        url: pathToActionDeleteImage,
        data: "id=" + globImgId,
        success: function(data) {
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#note_" + globImgId).remove();
                if ($('#sortable').html() == '') {
                    $('#images-save-sort').hide();
                    $('#images-list-block').html('<p>Нет картинок</p>');
                }
                $('#myModalDeleteImageGallerySuccess').modal('show');
            } else {                
                if (obj.message != '') {
                    $('#myModalDeleteImageGalleryErrorText').html(obj.message);
                    //alert(obj.message);
                } else {
                    $('#myModalDeleteImageGalleryErrorText').html('Ошибка');
                    //alert('упс..... ошибочка');
                }
                $('#myModalDeleteImageGalleryError').modal('show');
            }
        }
    });
    return false;
}

function saveImageInfo(id) {
    alt = $('#imageAlt_' + id).val();
    title = $('#imageTitle_' + id).val();    
    $.ajax({
        type: "POST",
        url: pathToActionEditMetaImage,
        data: "id=" + id + "&alt=" + alt + "&title=" + title,
        success: function(data) {
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $('#note_' + id).effect("highlight", {}, 3000);
            } else {
                if (obj.message != '') {
                    alert(obj.message);
                } else {
                    alert('упс..... ошибочка');
                }
            }
        }
    });
}