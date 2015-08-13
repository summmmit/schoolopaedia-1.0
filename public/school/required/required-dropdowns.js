var RequiredDropDowns = function() {

    'use strict';

    var addStates = function() {

        $('#state').each(function() {

            var i;
            for (i = 0; i < states.length; i++) {
                $('#state').append('<option value="' + states[i].code + '">' + states[i].name + '</option>');
            }
        });
    };

    return {
        //main function to initiate template pages
        init: function() {
            addStates();
        }
    };
}();