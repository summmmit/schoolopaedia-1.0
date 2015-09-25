var UserProfileSettings = function () {

    var callAjaxRequestOnRegisterButton = function () {

        //addDaysOfMonth('dd');
        addMonthsOfYear('mm');

        $.ajax({
            url: serverUrl + '/user/get/details',
            dataType: 'json',
            method: 'POST',
            success: function (data, response) {
                console.log(data);
                if (data.status == "success") {
                    attachUserDetails(data.result);
                    attachToFormDetails(data.result);
                }
            }
        });

        function attachUserDetails(result) {

            // table general information
            $('#table-user-general-information').find('#full_name').html(result.user_details.first_name + ' ' + result.user_details.middle_name + ' ' + result.user_details.last_name);
            $('#table-user-general-information').find('#username').html(result.user_details.username);
            $('#table-user-general-information').find('#dob').html(result.user_details.dob);
            if (result.user_details.sex) {
                $('#table-user-general-information').find('#sex').html('Female');
            } else {
                $('#table-user-general-information').find('#sex').html('Male');
            }
            //table contact information
            $('#table-user-contact-information').find('#email').html(result.user.email);
            $('#table-user-contact-information').find('#mobile_number').html(result.user_details.mobile_number);
            $('#table-user-contact-information').find('#home_number').html(result.user_details.home_number);
            //table additional information (social icons)
            $('#social-icons').find('#twitter').attr('href', 'http://www.twitter.com/' + result.user_details.twitter);
            $('#social-icons').find('#facebook').attr('href', 'http://www.facebook.com/' + result.user_details.facebook);
            $('#social-icons').find('#google').attr('href', 'http://www.google.com/' + result.user_details.google);
        }

        function attachToFormDetails(result) {
            $('#form-edit-user-details').find('#first_name').val(result.user_details.first_name);
            $('#form-edit-user-details').find('#middle_name').val(result.user_details.middle_name);
            $('#form-edit-user-details').find('#last_name').val(result.user_details.last_name);
            var dob = breakDateToYMD(result.user_details.dob);
            console.log(dob[2]);
            $('#form-edit-user-details').find('select[id="dd"]>option[value="' + dob[2] + '"]').prop('selected', 'selected');
            $('#form-edit-user-details').find('#mm').val();
            $('#form-edit-user-details').find('#yyyy').val(dob[0]);
            if (result.user_details.sex) {
                $('#form-edit-user-details').find('#female').prop("checked", true);
            } else {
                $('#form-edit-user-details').find('#male').prop("checked", true);
            }
            $('#form-edit-user-details').find('#mobile_number').val(result.user_details.mobile_number);
            $('#form-edit-user-details').find('#add_1').val(result.user_details.add_1);
            $('#form-edit-user-details').find('#add_2').val(result.user_details.add_2);
            $('#form-edit-user-details').find('#city').val(result.user_details.city);
            $('#form-edit-user-details').find('#pin_code').val(result.user_details.pin_code);
            $('#form-edit-user-details').find('#home_number').val(result.user_details.home_number);
            $('#form-edit-user-details').find('#twitter').val(result.user_details.twitter);
            $('#form-edit-user-details').find('#facebook').val(result.user_details.facebook);
            $('#form-edit-user-details').find('#google').val(result.user_details.google_plus);
            $('#form-edit-user-details').find('#skype').val(result.user_details.skype);
        }

        function breakDateToYMD(date) {
            var splinted_date = date.split("-");
            return splinted_date;
        }

        $('#update-user-details').on('click', function (e) {
            e.preventDefault();

            var data = {
                first_name: $('input[name="first_name"]').val(),
                middle_name: $('input[name="middle_name"]').val(),
                last_name: $('input[name="last_name"]').val(),
                mobile_number: $('input[name="mobile_number"]').val(),
                home_number: $('input[name="home_number"]').val(),
                sex: $('input[name="sex"]').val(),
                mm: $('#mm').val(),
                dd: $('#dd').val(),
                yyyy: $('#yyyy').val(),
                marital_status: $('#marital_status').val(),
                add_1: $('input[name="add_1"]').val(),
                add_2: $('input[name="add_2"]').val(),
                city: $('input[name="city"]').val(),
                state: $('#state').val(),
                country: $('#country').val(),
                pin_code: $('input[name="pin_code"]').val(),
                skype: $('input[name="skype"]').val(),
                facebook: $('input[name="facebook"]').val(),
                google_plus: $('input[name="google"]').val(),
                twitter: $('input[name="twitter"]').val(),
            };
            $.ajax({
                url: serverUrl + '/user/update/details',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: data,
                success: function (data, response) {
                    if (data.status == "failed") {
                        toastr.success(data.error.error_description);
                    } else if (data.status == "success") {
                        attachUserDetails(data.result);
                        attachToFormDetails(data.result);
                        toastr.warning('You Have Successfully Updated Your details');
                        window.location = '#panel_overview';
                    }
                }
            });
        });

        $('#button-update-email').on('click', function (e) {
            e.preventDefault();

            var data = {
                'email' : $('#udpate-email-address').find('#email').val()
            }
            console.log(data);
        });
    };

    function sendRequest(data, url_data_from, url_change_page_to) {

        $.ajax({
            url: url_data_from,
            dataType: 'json',
            cache: false,
            method: 'POST',
            data: data,
            success: function (result, response) {
                console.log(result);

                if (result.status == "failed") {
                    errorHandler(result.error.result);
                } else if (result.status == "success") {
                    //changeUrl(url_change_page_to);
                }
            }
        });
    }

    return {
        //main function to initiate template pages
        init: function () {
            callAjaxRequestOnRegisterButton();
        }
    };
}();