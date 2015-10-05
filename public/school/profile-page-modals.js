var ProfilePageModals = function () {
    "use strict";
    //function to initiate bootstrap extended modals

    $('.avatar').hover(function () {
        $(this).find('.upload-btn').removeClass('no-display');
    }, function () {
        $(this).find('.upload-btn').addClass('no-display');
    });


    $('.cover-image').hover(function () {
        $(this).find('.cover-upload-btn').removeClass('no-display');
    }, function () {
        $(this).find('.cover-upload-btn').addClass('no-display');
    });

    var initProfileImage = function () {

        $.ajax({
            url: serverUrl + '/user/get/details',
            dataType: 'json',
            cache: false,
            method: 'POST',
            success: function (data, response) {
                if(data.status == "success"){
                    if(data.result.user_details.pic){
                        updateFormPreviewImage(data.result.user_details.pic);
                    }
                    if(data.result.user_details.cover_pic){
                        updateCoverImage(data.result.user_details.cover_pic);
                    }
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

        function updateAllProfileImages(pic) {
            updateFormPreviewImage(pic);
            $('#left_menu_profile_image').attr('src', serverUrl + '/school/images/user/profile_images/' + pic);
            $('#upper_dropdown_menu_profile_image').attr('src', serverUrl + '/school/images/user/profile_images/' + pic);
        }

        function updateCoverImage(pic){
            $('#user-cover-pic').attr('src', serverUrl + '/school/images/user/cover_pics/' + pic);
        }

        $('#profile_image').on('change', function(e){
            e.preventDefault();
            $('#button_update_profile_image').removeClass('no-display');
        });

        $('#button_update_profile_image').on('click', function (e) {
            e.preventDefault();

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
                        $('#button_update_profile_image').addClass('no-display');
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

        $('#cover_image').on('change', function(e){
            e.preventDefault();

            $.ajax({
                url: serverUrl + '/user/update/cover/pic',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: new FormData($('#cover_image_change')[0]),
                processData: false, // Don't process the files
                contentType: false, // Set content type to false
                success: function (data, response) {
                    if (data.status == "success") {
                        updateCoverImage(data.result.cover_pic);
                        toastr.success('You have successfully updated your profile pic.');
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
            initProfileImage();
        }
    };
}(); 