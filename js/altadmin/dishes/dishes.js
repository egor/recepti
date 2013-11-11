function dishesDelete(id) {
    if (!confirm("Уверены, что хотите удалить рецепт?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/altadmin/dishes/delete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="6" class="u-delete">рецепт удален</td>');
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
