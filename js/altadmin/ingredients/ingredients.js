function ingredientsDelete(id) {
    if (!confirm("Уверены, что хотите удалить ингредиент?")) {
        return true;
    }
    $.ajax({
        type: "GET",
        url: "/altadmin/ingredients/delete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="2" class="u-delete">Ингредиент удален</td>');
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