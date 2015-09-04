var AdminSchoolSettings = function(){

    var SchoolSettings = function(){

        $.ajax({
            url: serverUrl + '/admin/school/information/post',
            dataType: 'json',
            method: 'POST',
            success: function (data, response) {
                if (data.status == "success") {
                    addSchoolSettings(data.result)
                } else if (data.status == "failed") {
                    toastr.warning(data.error.error_description);
                }
            }
        });

        function addSchoolSettings(result){

            $('#data-school-name').html(result.school_name);
            $('#data-school-logo').html(result.logo);
            $('#data-school-manager').html(result.manager_full_name);
            $('#data-school-phone-number').html(result.phone_number);
            $('#data-school-email').html(result.email);
            $('#data-school-address').html(result.add_1 + ' ' + result.add_2);
            $('#data-school-city').html(result.city);
            $('#data-school-state').html(result.state);
            $('#data-school-country').html(result.country);
            $('#data-school-pin-code').html(result.pin_code);

            $('#school-registration-code').html(result.registration_code);
            $('#code-for-admin').html(result.code_for_admin);
            $('#code-for-students').html(result.code_for_students);
            $('#code-for-teachers').html(result.code_for_teachers);
        }
    }
    return {
        //main function to initiate template pages
        init: function () {
            SchoolSettings();
        }
    };
}();