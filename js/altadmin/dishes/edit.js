/**
 * Удаление картинки рецепта
 * 
 * @param {integer} id - id рецепта
 * @returns {Boolean}
 */
function dishesDeleteMainPic(id, type) {
    if (!confirm("Уверены, что хотите удалить картинку?")) {
        return true;
    }
    $.ajax({
        type: "GET",
        url: "/altadmin/dishes/deleteMainPic",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#main-img").html('<div class="main-img">картинка удалена</div>');
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