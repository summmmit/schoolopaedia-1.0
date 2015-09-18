var IntialSettings = function() {
    "use strict";
    var fetchClassesFromStreamId = function() {

        $.ajax({
            url: serverUrl + '/admin/get/current/session',
            dataType: 'json',
            method: 'POST',
            cache: false,
            success: function (data, response) {
                if(data.status == "success"){
                    attachAllSessions(data.result);
                }
            }
        });

        function attachAllSessions(result){
            $('#form-field-select-session').append('<option value="'+ result.id +'">'+ result.session_start +'To'+ result.session_end +'</option>');
        }

        $('#form-field-select-session').on('change', function() {

            var session_id = $(this).val();
            if(session_id){

                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Fetching Streams Available.....'
                });
                hideClasses();
                hideSections();
                hideRegisterButton();
                removeAllStreams();
                $.ajax({
                    url: serverUrl + '/admin/get/all/streams',
                    dataType: 'json',
                    method: 'POST',
                    cache: false,
                    success: function (data, response) {
                        $.unblockUI();
                        if(data.status == "success"){
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllStreams(data.result[i]);
                            }
                            showStreams();
                        }
                    }
                });
            }else{
                hideStreams();
                hideClasses();
                hideSections();
                hideRegisterButton();
            }
        });

        function attachAllStreams(result){
            $('#form-field-select-stream').append('<option value="'+ result.id +'">'+ result.stream_name +'</option>');
        }

        $('#form-field-select-stream').on('change', function() {

            var stream_id = $(this).val();

            if (stream_id) {

                var data = {
                    stream_id: stream_id
                };

                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Fetching Classes Available...'
                });
                hideSections();
                hideRegisterButton();
                removeAllClasses();
                $.ajax({
                    url: serverUrl + '/admin/get/all/classes/by/stream/id',
                    dataType: 'json',
                    data: data,
                    method: 'POST',
                    success: function(data, response) {
                        $.unblockUI();
                        if(data.status == "success"){
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllClasses(data.result[i]);
                            }
                            showClasses();
                        }
                    }
                });
            }else{
                hideClasses();
                hideSections();
                hideRegisterButton();
            }
        });

        function attachAllClasses(result){
            $('#form-field-select-class').append('<option value="' + result.id + '">' + result.class_name + '</option>');
        }

        $('#form-field-select-class').on('change', function() {

            var class_id = $(this).val();
            if (class_id) {

                var data = {
                    class_id: class_id
                };
                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Fetching Section to Your Class...'
                });
                hideRegisterButton();
                removeAllSections();
                $.ajax({
                    url: serverUrl + '/admin/get/all/sections/by/class/id',
                    dataType: 'json',
                    data: data,
                    method: 'POST',
                    success: function(data, response) {
                        $.unblockUI();
                        if(data.status == "success"){
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllSections(data.result[i]);
                            }
                            showSections();
                        }
                    }
                });
            }else{
                hideSections();
                hideRegisterButton();
            }
        });

        function attachAllSections(result){
            $('#form-field-select-section').append('<option value="' + result.id + '">' + result.section_name + '</option>');
        }

        function removeAllSections(){
            $('#form-field-select-section').empty();
            $('#form-field-select-section').append('<option value="">Select a Section.....</option>');
        }

        function removeAllClasses(){
            $('#form-field-select-class').empty();
            $('#form-field-select-class').append('<option value="">Select a Section.....</option>');
        }

        function showStreams(){
            $('#form-field-select-stream').closest('.form-group').removeClass('no-display')
        }

        function hideStreams(){
            $('#form-field-select-stream').closest('.form-group').addClass('no-display')
        }

        function showClasses(){
            $('#form-field-select-class').closest('.form-group').removeClass('no-display');
        }

        function hideClasses(){
            $('#form-field-select-class').closest('.form-group').addClass('no-display');
        }

        function showSections(){
            $('#form-field-select-section').closest('.form-group').removeClass('no-display');
        }

        function hideSections(){
            $('#form-field-select-section').closest('.form-group').addClass('no-display');
        }

        function removeAllStreams(){
            $('#form-field-select-stream').empty();
            $('#form-field-select-stream').append('<option value="">Select a Section.....</option>');
        }

        function showRegisterButton(){
            $('#form-button-submit').removeClass('no-display');
        }

        function hideRegisterButton(){
            $('#form-button-submit').addClass('no-display');
        }

        $('#form-field-select-section').on('change', function() {

            var section_id = $(this).val();

            if (section_id) {
                showRegisterButton();
            }else{
                hideRegisterButton();
            }
        });

        $('#form-button-submit').on('click', function(e){
            e.preventDefault();

            var data = {
                session_id : $('#form-field-select-session').val(),
                stream_id : $('#form-field-select-stream').val(),
                class_id : $('#form-field-select-class').val(),
                section_id : $('#form-field-select-section').val(),
            };

            $.ajax({
                url: serverUrl + '/user/class/set/intial/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function(data, response) {
                    if(data.status == "success"){
                        changeUrl(serverUrl + '/user/home');
                    }
                }
            });
        });

    };
    return {
        //main function to initiate template pages
        init: function() {
            fetchClassesFromStreamId();
        }
    };
}();