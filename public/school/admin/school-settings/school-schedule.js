var AdminSchoolSchedule = function () {
    "use strict";
    var SchoolSchedule = function () {

        $.ajax({
            url: serverUrl + '/admin/school/get/all/schedule/profile/post',
            dataType: 'json',
            method: 'POST',
            success: function (data, response) {
                if (data.status == "success") {
                    console.log(data);
                    addRowsToScheduleProfilesTable(data.result);
                } else if (data.status == "failed") {
                    toastr.warning(data.error.error_description);
                }
            }
        });

        $('#form-submit-new-schedule-profile').on('click', function (e) {
            e.preventDefault();

            var data = {
                'profile_name': $('input[name="profile_name"]').val()
            };

            $.ajax({
                url: serverUrl + '/admin/school/set/schedule/profile/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    if (data.status == "success") {
                        addNewRowToScheduleProfilesTable(data.result);
                        $.hideSubview();
                        toastr.info("You Have successfully created this Schedule");
                        $('input[name="profile_name"]').val('');
                    } else if (data.status == "failed") {

                        toastr.warning(data.error.error_description);
                    }
                    //addNewRowToScheduleTable(data.result.schedule);
                }
            });

        });

        function addRowsToScheduleProfilesTable(result) {

            var i;
            for(i=0; i<result.length; i++){

                var table_row = '<tr data-schedule-profile-id="'+ result[i].id +'"><td class="center">'+ result[i].profile_name +'</td><td class="center"><div class="checkbox-table">' +
                    '<label><input type="checkbox" class="flat-grey foocheck"></label></div></td><td class="center"><div class="visible-md visible-lg hidden-sm hidden-xs">' +
                    '<a href="#" id="schedule-profile-edit" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Show"><i class="fa fa-edit"></i></a> ' +
                    '<a href="#" id="schedule-profile-delete" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a></div>' +
                    '<div class="visible-xs visible-sm hidden-md hidden-lg"><div class="btn-group"><a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">' +
                    '<i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right dropdown-dark"><li><a role="menuitem" tabindex="-1" href="#">' +
                    '<i class="fa fa-edit"></i> Edit</a></li><li><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-times"></i> Remove</a></li></ul></div></div></td></tr>';

                $('#table-schedule-profiles').find('tbody').append(table_row);
            }
        }

        function addNewRowToScheduleProfilesTable(result) {

                var table_row = '<tr data-schedule-profile-id="'+ result.id +'"><td class="center">'+ result.profile_name +'</td><td class="center"><div class="checkbox-table">' +
                    '<label><input type="checkbox" class="flat-grey foocheck"></label></div></td><td class="center"><div class="visible-md visible-lg hidden-sm hidden-xs">' +
                    '<a href="#" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Show"><i class="fa fa-edit"></i></a> ' +
                    '<a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a></div>' +
                    '<div class="visible-xs visible-sm hidden-md hidden-lg"><div class="btn-group"><a class="btn btn-green dropdown-toggle btn-sm" data-toggle="dropdown" href="#">' +
                    '<i class="fa fa-cog"></i> <span class="caret"></span></a><ul role="menu" class="dropdown-menu pull-right dropdown-dark"><li><a id="schedule-profile-edit" role="menuitem" tabindex="-1" href="#">' +
                    '<i class="fa fa-edit"></i> Edit</a></li><li><a id="schedule-profile-delete" role="menuitem" tabindex="-1" href="#"><i class="fa fa-times"></i> Remove</a></li></ul></div></div></td></tr>';

                $('#table-schedule-profiles').find('tbody').append(table_row);
        }

        $('#form-submit-new-schedule').on('click', function (e) {
            e.preventDefault();

            var schedule_starts_from = $(this).parents('form').find('#schedule-starts-from').val();
            var schedule_ends_untill = $(this).parents('form').find('#schedule-ends-untill').val();
            var school_opening_time = $(this).parents('form').find('#school-opening-time').val();
            var school_lunch_time = $(this).parents('form').find('#school-lunch-time').val();
            var school_closing_time = $(this).parents('form').find('#school-closing-time').val();

            var data = {
                schedule_starts_from: schedule_starts_from,
                schedule_ends_untill: schedule_ends_untill,
                school_opening_time: school_opening_time,
                school_lunch_time: school_lunch_time,
                school_closing_time: school_closing_time
            }

            console.log(data);

            $.ajax({
                url: serverUrl + '/admin/school/set/schedule/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    if (data.status == "success") {
                        $.hideSubview();
                        toastr.info("You Have successfully created this Schedule");
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
                    }
                    //addNewRowToScheduleTable(data.result.schedule);
                }
            });

        });

        $('#schedule-profile-delete').on('click', function (e) {

            var schedule_profile_id = $(this).closest('tr').attr('data-schedule-profile-id');
            alert(schedule_profile_id);

        });

        function addNewRowToScheduleTable(schedule) {
            var header = '<tr><td colspan="2" class="text-center text-box-light"> ' + moment(schedule.start_from).format('MMMM') + ' - ' + moment(schedule.close_untill).format('MMMM') + '</td></tr>';
            var opening_time = '<tr><td class="column-left">School Opening Time</td><td class="column-right"><a href="#" class="opening-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="' + schedule.id + '">' + schedule.opening_time + '</a></td></tr>';
            var lunch_time = '<tr><td class="column-left">Lunch Time</td><td class="column-right"><a href="#" class="lunch-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="' + schedule.id + '">' + schedule.lunch_time + '</a></td></tr>';
            var closing_time = '<tr><td class="column-left">School Opening Time</td><td class="column-right"><a href="#" class="closing-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="' + schedule.id + '">' + schedule.closing_time + '</a></td></tr>';


            $('#table-school-schedule').find('tbody').append(header).append(opening_time).append(lunch_time).append(closing_time);
            $('#form-new-schedule').find('input').val(' ');


            $('.opening-time').editable({
                validate: function (value) {
                    if ($.trim(value) == '')
                        return 'Value is required.';
                },
                url: 'http://localhost/projects/schools/public/admin/admin/ajax/school/timings/start/from',
                title: 'Edit Start_from',
                type: 'text',
                send: 'always',
                ajaxOptions: {
                    dataType: 'json'
                }
            });
            $('.lunch-time').editable({
                validate: function (value) {
                    if ($.trim(value) == '')
                        return 'Value is required.';
                },
                url: 'http://localhost/projects/schools/public/admin/admin/ajax/school/timings/lunch/from',
                title: 'Edit Start_from',
                type: 'text',
                send: 'always',
                ajaxOptions: {
                    dataType: 'json'
                }
            });
            $('.closing-time').editable({
                validate: function (value) {
                    if ($.trim(value) == '')
                        return 'Value is required.';
                },
                url: 'http://localhost/projects/schools/public/administrator/admin/ajax/school/timings/close/from',
                title: 'Edit Start_from',
                type: 'text',
                send: 'always',
                ajaxOptions: {
                    dataType: 'json'
                }
            });

        }

    };

    return {
        //main function to initiate template pages
        init: function () {
            SchoolSchedule();
        }
    };
}();