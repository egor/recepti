function deleteImage(id) {
    if (!confirm("Уверены, что хотите удалить куртинку?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: pathToActionDeleteImage,
        data: "id=" + id,
        success: function(data) {
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#note_" + id).remove();
                if ($('#sortable').html() == '') {
                    $('#images-save-sort').hide();
                    $('#images-list-block').html('<p>Нет картинок</p>');
                }
            } else {
                if (obj.message != '') {
                    alert(obj.message);
                } else {
                    alert('упс..... ошибочка');
                }
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