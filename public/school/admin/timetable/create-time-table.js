/**
 * Created by summmmit on 3/28/2015.
 */
var CreateTimeTable = function() {
    "use strict";
    var TimeTableFunction = function () {
        $('#field-select-time-table-class').on('change', function() {
            var optionValue = $(this).val();

            if(optionValue){
                $('#table-class-time-table').removeClass('no-display');
            }else{
                $('#table-class-time-table').addClass('no-display');
            }

        });

    };

    var fetchClasses = function() {

        $.ajax({
            url: 'http://localhost/projects/schoolopaedia/public/admin/time/table/get/class/streams/pair',
            dataType: 'json',
            method: 'POST',
            success: function(data, response) {
                var i;
                for (i = 0; i < data.stream_class_pairs.length; i++) {
                    $('#field-select-time-table-class').append('<option value=' + data.stream_class_pairs[i].classes_id + '>' + data.stream_class_pairs[i].stream_class_pair + '</option>');
                }
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function() {
            TimeTableFunction();
            fetchClasses();
        }
    };
}();
