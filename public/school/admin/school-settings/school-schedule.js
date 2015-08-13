var Schedule = function() {
    "use strict";
    var schoolschedule = function() {

        $('#form-submit-new-schedule').on('click', function(e) {
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

            $.ajax({
                url: 'http://localhost/projects/schools/public/admin/admin/school/set/schedule/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function(data, response) {
                    $.hideSubview();
                    addNewRowToScheduleTable(data.result.schedule);
                    toastr.info("You Have successfully created this Schedule");
                }
            });

        });

        function addNewRowToScheduleTable(schedule) {
            var header = '<tr><td colspan="2" class="text-center text-box-light"> ' + moment(schedule.start_from).format('MMMM') + ' - ' + moment(schedule.close_untill).format('MMMM') + '</td></tr>';
            var opening_time = '<tr><td class="column-left">School Opening Time</td><td class="column-right"><a href="#" class="opening-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="' + schedule.id + '">' + schedule.opening_time + '</a></td></tr>';
            var lunch_time = '<tr><td class="column-left">Lunch Time</td><td class="column-right"><a href="#" class="lunch-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="' + schedule.id + '">' + schedule.lunch_time + '</a></td></tr>';
            var closing_time = '<tr><td class="column-left">School Opening Time</td><td class="column-right"><a href="#" class="closing-time" data-type="combodate" data-template="HH:mm A" data-format="HH:mm A" data-viewformat="HH:mm A" data-pk="' + schedule.id + '">' + schedule.closing_time + '</a></td></tr>';


            $('#table-school-schedule').find('tbody').append(header).append(opening_time).append(lunch_time).append(closing_time);
            $('#form-new-schedule').find('input').val(' ');


            $('.opening-time').editable({
                validate: function(value) {
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
                validate: function(value) {
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
                validate: function(value) {
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
        init: function() {
            schoolschedule();
        }
    };
}();