var AdminHome = function () {

    var widgets = function () {

        var students = 0;
        var teachers;

        var total_students = function () {

            $.ajax({
                url: serverUrl + '/admin/get/all/students',
                dataType: 'json',
                cache: false,
                method: 'POST',
                success: function (data, response) {
                    $('#total_number_students').text(data.result.length);
                }
            });
        }

        var total_teachers = function () {

            $.ajax({
                url: serverUrl + '/admin/get/all/teachers',
                dataType: 'json',
                cache: false,
                method: 'POST',
                success: function (data, response) {
                    $('#total_number_teachers').text(data.result.length);
                }
            });
        }

        var polling = setInterval(function () {
            var new_student = total_students();
            if(new_student > students){
                toastr.info('Congrates. New student');
                students = new_student;
            }
            total_teachers();
        }, 3000);

        total_students();
        total_teachers();
    };
    return {
        //main function to initiate template pages
        init: function () {
            widgets();
        }
    };
}();