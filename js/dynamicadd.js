$('#addDynamicExtraFieldButton').click(function(event) {
    addDynamicExtraField();
    return false;
 });
function addDynamicExtraField() {
    var div = $('<div/>', {
        'class' : 'DynamicExtraField'
    }).appendTo($('#DynamicExtraFieldsContainer'));
    var br = $('<br/>').appendTo(div);
    var label = $('<label/>').html("Доп. поле ").appendTo(div);
    var input = $('<input/>', {
        value : 'Удаление',
        type : 'button',
        'class' : 'DeleteDynamicExtraField'
    }).appendTo(div);
    input.click(function() {
        $(this).parent().remove();
    });
    var br = $('<br/>').appendTo(div);
    var textarea = $('<textarea/>', {
        name : 'DynamicExtraField[]',
        cols : '50',
        rows : '3'
    }).appendTo(div);
}
//Для удаления первого поля
$('.DeleteDynamicExtraField').click(function(event) {
                $(this).parent().remove();
                return false;
            });
