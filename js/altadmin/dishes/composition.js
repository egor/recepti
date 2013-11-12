/**
 * Сохранение ингредиента при добавлении или редактировании
 * 
 * @param {type} id - id рецепта к которому относится ингредиент
 * @param integer edit - 0 - добавление, 1 - редактирование
 * @param integer iId - id ингредиента при редактировании (при добавлении = 0)
 * @returns {Boolean}
 */
function compositionAddSave(id, edit, iId) {    
    ingredients_id = $('#Composition_ingredients_id').val();
    units_id = $('#Composition_units_id').val();
    info = $('#Composition_info').val();
    if ($('#Composition_required').is(':checked')) {
        required = 1;
    } else {
        required = 0;
    }    
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

/**
 * Вывод формы добавления ингредиента
 * 
 * @param {type} id
 * @returns {Boolean}
 */
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

/**
 * Проверка на json массив
 * 
 * @param {type} data
 * @returns {Boolean}
 */
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

/**
 * Вывод списка ингредиентов рецепта
 * 
 * @param integer id - id рецепта
 * @returns {undefined}
 */
function compositionShowList(id){
    $.ajax({
        type: "GET",                    
        url: "/altadmin/dishes/compositionShowList",
        data: "id=" + id,    
        success: function(data){            
            $(".ingridients_list").html(data);            
        }
    });
}

/**
 * Удаление ингредиента из рецепта
 * 
 */
function compositionDelete(id) {
     if (!confirm("Уверены, что хотите удалить ингредиент?")) {
        return true;
    }
    $.ajax({
        type: "GET",
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
 * Редактирование ингредиента в рецепте
 * 
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

/**
 * Отмена добавление или редактирования ингредиента
 * 
 * @returns {Boolean}
 */
function compositionCancelSave() {
    $(".ingridients_form").hide();
    return false;
}