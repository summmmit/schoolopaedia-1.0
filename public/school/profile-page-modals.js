var ProfilePageModals = function () {
    "use strict";
    //function to initiate bootstrap extended modals

    $('.avatar').hover(function () {
        $(this).find('.upload-btn').removeClass('no-display');
    }, function () {
        $(this).find('.upload-btn').addClass('no-display');
    });

    var initModals = function () {

        $.ajax({
            url: serverUrl + '/user/get/details',
            dataType: 'json',
            cache: false,
            method: 'POST',
            success: function (data, response) {
                if(data.status == "success" && data.result.user_details.pic){
                    updateFormPreviewImage(data.result.user_details.pic);
                }
            },
            error: function (result) {
                console.log("error");
            }
        });

        function updateFormPreviewImage(result) {
            updateProfileImage(result);
            $('#profile_image_change').find('#profile_image_update_icon').attr('src', serverUrl + '/school/images/user/profile_images/' + result);
        }

        function updateProfileImage(pic){
            $('#img-profile').attr('src', serverUrl + '/school/images/user/profile_images/' + pic);
        }

        $('#profile_image').on('change', function(e){
            $('#button_update_profile_image').removeClass('no-display');
        });

        $('#button_close_profile_image').on('click', function(e){
            $('#button_update_profile_image').addClass('no-display');
        });

        function updateAllProfileImages(pic) {
            updateFormPreviewImage(pic);
            $('#left_menu_profile_image').attr('src', serverUrl + '/school/images/user/profile_images/' + pic);
            $('#upper_dropdown_menu_profile_image').attr('src', serverUrl + '/school/images/user/profile_images/' + pic);
        }

        $('#button_update_profile_image').on('click', function (e) {
            e.preventDefault();

            // START A LOADING SPINNER HERE
            $.ajax({
                url: serverUrl + '/user/update/profile/pic',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: new FormData($('#profile_image_change')[0]),
                processData: false, // Don't process the files
                contentType: false, // Set content type to false
                success: function (data, response) {
                    if (data.status == "success") {
                        updateAllProfileImages(data.result.pic);
                        toastr.success('You have successfully updated your profile pic.');
                        $('.modal').modal('hide');
                    } else {
                        toastr.warning(data.error.error_description);
                    }
                },
                error: function (data) {
                    toastr.warning(data);
                }
            });
        });
    };
    return {
        init: function () {
            initModals();
        }
    };
}(); 