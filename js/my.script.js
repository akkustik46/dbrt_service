function loadCity(select)
{
    var citySelect = $('select[id="'+select.name+'"]');

    // послыаем AJAX запрос, который вернёт список городов для выбранной области
    $.getJSON('/add/query1.php', {action:'getWork', types:select.value}, function(cityList){
        citySelect.html(''); // очищаем список городов

        // заполняем список городов новыми пришедшими данными
        $.each(cityList, function(i){
            citySelect.append('<option value="' + i + '">' + this + '</option>');
        });
	citySelect.removeAttr('disabled');
    });
}
function loadBike(select)
{
    var bikeSelect = $('select[id="clbike"]');

    // послыаем AJAX запрос, который вернёт список городов для выбранной области
    $.getJSON('query-clbike.php', {action:'getBikes', bikes:select.value}, function(bikeList){
        bikeSelect.html(''); // очищаем список городов

        // заполняем список городов новыми пришедшими данными
        $.each(bikeList, function(i){
            bikeSelect.append('<option value="' + i + '">' + this + '</option>');
        });
	bikeSelect.removeAttr('disabled');
    });
}
