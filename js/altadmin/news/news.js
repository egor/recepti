function newsDelete(id) {
    if (!confirm("Уверены, что хотите удалить новость?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/altadmin/news/delete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="6" class="u-delete">новость удалена</td>');
                $("#tr-"+id).hide(3500);
            } else {
                if (obj.message != '') {
                    alert (obj.message);
                } else {
                    alert ('упс..... ошибочка');
                }
            }
        }
    });
    return false;
}
