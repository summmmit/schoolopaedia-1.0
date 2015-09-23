var TeacherIntialSettings = function() {
    "use strict";

    function showRegisterButton() {
        $('#form-button-submit').removeClass('no-display');
    }

    function hideRegisterButton() {
        $('#form-button-submit').addClass('no-display');
    }

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
            $('#form-field-select-session').append('<option value="'+ result.id +'">'+ result.session_start +' To '+ result.session_end +'</option>');
        }

        $('#form-field-select-session').on('change', function() {

            var session_id = $(this).val();

            if (session_id) {
                showRegisterButton();
            }else{
                hideRegisterButton();
            }
        });

        $('#form-button-submit').on('click', function(e){
            e.preventDefault();

            var data = {
                session_id : $('#form-field-select-session').val(),
            };

            console.log(data);

            $.ajax({
                url: serverUrl + '/teacher/class/set/intial/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function(data, response) {

                    console.log(data);
                    if(data.status == "success"){
                        changeUrl(serverUrl + '/teacher/home');
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