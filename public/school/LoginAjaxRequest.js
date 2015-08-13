var LoginAjaxRequest = function(){

    var callAjaxRequestOnRegisterButton = function(){

        $('#register-user').on('click', function(e){

            e.preventDefault();
            removeAlertsAndErrors();
            var data = {
                email : $('input[name="email"]').val(),
                password : $('input[name="password"]').val(),
                password_again : $('input[name="password_again"]').val(),
                _token: $('input[name="_token"]').val()
            };

            var url_data_from = 'http://localhost/projects/school/web/public/account/user/create';
            var url_change_page_to = 'http://localhost/projects/school/web/public/user/sign/in';

            sendRequest(data, url_data_from, url_change_page_to);
        });
    };

    function sendRequest(data, url_data_from, url_change_page_to){

        $.ajax({
            url: url_data_from,
            dataType: 'json',
            cache: false,
            method: 'POST',
            data: data,
            success: function(result, response) {
                console.log(result);

                if(result.status == "failed"){
                    errorHandler(result.error.result);
                }else if(result.status == "success"){
                    //changeUrl(url_change_page_to);
                }
            }
        });
    }

    function errorHandler(errors){
        for(var prop in errors) {
            $('input[name="'+ prop +'"]').parent().append('<span for="'+ prop +'" class="help-block">'+ errors[prop] +'</span>');
        }
    }

    function removeAlertsAndErrors(){

        if($('.errorHandler').hasClass('no-display') == false){
            $('.errorHandler').addClass('no-display');
        }
        $('.help-block').remove();
    }

    function changeUrl(url){
        window.location = url;
    }

    return {
        //main function to initiate template pages
        init : function() {
            callAjaxRequestOnRegisterButton();
        }
    };
}();