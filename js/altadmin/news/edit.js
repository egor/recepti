function newsDeletePic(id) {
    if (!confirm("Уверены, что хотите удалить картинку?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/altadmin/news/deletePic",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#main-img").html('<div class="main-img">картинка удалена</div>');
                //$("#main-img").hide(3500);
                //Нет фото
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
