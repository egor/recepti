function userDelete(id) {
    if (!confirm("Уверены, что хотите удалить пользователя?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/altadmin/user/delete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="4" class="u-delete">пользователь удален</td>');
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
