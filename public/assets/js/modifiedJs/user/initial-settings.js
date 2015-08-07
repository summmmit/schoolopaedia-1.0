var IntialSettings = function() {
    "use strict";
    var fetchClassesFromStreamId = function() {



        $('#form-field-select-session').on('change', function() {

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Fetching Streams Available.....'
            });
            $('#form-field-select-stream').parentsUntil('form-group').removeClass('no-display');
            $.unblockUI();
        });

        $('#form-field-select-stream').on('change', function() {

            var stream_id = $(this).val();
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Fetching Classes Available...'
            });
            if (stream_id) {
                $('#form-field-select-class').parentsUntil('form-group').removeClass('no-display');

                var data = {
                    stream_id: stream_id
                };

                $.ajax({
                    url: 'http://localhost/projects/schoolopaedia/public/user/classes/from/stream/id',
                    dataType: 'json',
                    data: data,
                    method: 'POST',
                    success: function(data, response) {
                        $.unblockUI();
                        var i;
                        for (i = 0; i < data.result.classes.length; i++) {
                            $('#form-field-select-class').append('<option value="' + data.result.classes[i].id + '">' + data.result.classes[i].class + '</option>');
                        }
                    }
                });

            }

        });

        $('#form-field-select-class').on('change', function() {

            var class_id = $(this).val();
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Fetching Section to Your Class...'
            });
            if (class_id) {
                $('#form-field-select-section').parentsUntil('form-group').removeClass('no-display');

                var data = {
                    class_id: class_id
                };

                $.ajax({
                    url: 'http://localhost/projects/schoolopaedia/public/user/get/sections/from/class/id',
                    dataType: 'json',
                    data: data,
                    method: 'POST',
                    success: function(data, response) {
                        $.unblockUI();
                        var i;
                        for (i = 0; i < data.result.sections.length; i++) {
                            $('#form-field-select-section').append('<option value="' + data.result.sections[i].id + '">' + data.result.sections[i].section_name + '</option>');
                        }
                    }
                });

            }
            
        });

        $('#form-field-select-section').on('change', function() {

            var section_id = $(this).val();

            if (section_id) {
                $('#form-button-submit').removeClass('no-display');
            }
        });

    };

    return {
        //main function to initiate template pages
        init: function() {
            fetchClassesFromStreamId();
        }
    };
}();