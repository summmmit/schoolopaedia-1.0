

function indianStates() {

    $('#state').each(function() {

        for (var i = 0; i < states.length; i++) {
            $('#state').append('<option value="' + states[i].code + '">' + states[i].name + '</option>');
        }
    });
};

function addDaysOfMonth(id){

    for (var i = 1; i <= 31; i++) {
        $('#'+id).append('<option value="' + i + '" selected="">' + i + '</option>');
    }
}

function addMonthsOfYear(id){

    for (var i = 1; i <= 12; i++) {
        $('#'+id).append('<option value="' + i + '" selected="">' + i + '</option>');
    }
}