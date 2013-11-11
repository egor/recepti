function unitsDelete(id) {
    if (!confirm("Уверены, что хотите удалить еденицу измерения?")) {
        return true;
    }
    $.ajax({
        type: "GET",
        url: "/altadmin/units/delete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="2" class="u-delete">Еденица измерения удалена</td>');
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