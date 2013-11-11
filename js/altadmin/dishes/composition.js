
function compositionAddSave(id, edit, iId) {    

    ingredients_id = $('#Composition_ingredients_id').val();
    units_id = $('#Composition_units_id').val();
    info = $('#Composition_info').val();
    required = $('#Composition_required').val();
    count = $('#Composition_count').val();
    if (edit == 1) {
        gUrl = "/altadmin/dishes/compositionEdit";
    } else {
        gUrl = "/altadmin/dishes/compositionAdd";
    }
    $.ajax({
        type: "POST",
        url: gUrl,
        data: "id=" + id + "&ingredients_id="+ingredients_id+"&units_id="+units_id+"&info="+info+"&required="+required+"&count="+count+"&iId="+iId,                
        success: function(data){            
            if (isJSON(data)) {
                var obj = $.parseJSON(data);
                if (obj.error == 1) {            
                    $(".ingridients_form").html('');
                }
                if (obj.error == 0) {            
                    compositionShowList(id);
                    $(".ingridients_form").html('Сохранено');
                    $(".ingridients_form").hide();
                }            
            } else {
                $(".ingridients_form").html(data);
            }
        }
    });
    return false;
}
function compositionAdd(id) {    
    $(".ingridients_form").html('');
    $(".ingridients_form").show(); 
    $.ajax({
        type: "POST",                    
        url: "/altadmin/dishes/compositionAdd",
        data: "id=" + id,    
        success: function(data){            
            $(".ingridients_form").html(data);            
        }
    });
    return false;
}
function isJSON(data) {
    var isJson = false
    try {
        // this works with JSON string and JSON object, not sure about others
        var json = $.parseJSON(data);
        isJson = typeof json === 'object' ;
    } catch (ex) {
        console.error('data is not JSON');
    }
    return isJson;
}
    
function compositionShowList(id){
    $.ajax({
        type: "POST",                    
        url: "/altadmin/dishes/compositionShowList",
        data: "id=" + id,    
        success: function(data){            
            $(".ingridients_list").html(data);            
        }
    });
}

/**
 * Удаление компонента из состава
 */
function compositionDelete(id) {
     if (!confirm("Уверены, что хотите удалить компонент?")) {
        return true;
    }
    $.ajax({
        type: "POST",
        url: "/altadmin/dishes/compositionDelete",
        data: "id=" + id,                
        success: function(data){
            var obj = $.parseJSON(data);
            if (obj.error == 0) {
                $("#tr-"+id).html('<td colspan="6" class="u-delete">компонент удален</td>');
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

/**
 * Редактирование компонента из состава
 */
function compositionEdit(iId) {
    $(".ingridients_form").html('');
    $(".ingridients_form").show(); 
    $.ajax({
        type: "POST",                    
        url: "/altadmin/dishes/compositionEdit",
        data: "iId=" + iId,    
        success: function(data){            
            $(".ingridients_form").html(data);            
        }
    });
    return false;
}