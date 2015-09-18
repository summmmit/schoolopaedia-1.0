var TableDataSchoolScheduleNew = function () {
    "use strict";
    var runDataTable_example2 = function () {
        var newRow = false;
        var actualEditingRow = null;

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control" value="' + aData[2] + '">';

            jqTds[3].innerHTML = '<a class="save-row" href="">Save</a>';
            jqTds[4].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            //var jqInputs = $('input', nRow);
            oTable.fnUpdate(result.profile_name, nRow, 0, false);
            oTable.fnUpdate('<input type="radio" name="schedule_profile_make_current" class="flat-grey" id="schedule_profile_make_current">', nRow, 1, false);
            oTable.fnUpdate('<a class="show-schedules-row" href="">Schedule</a>', nRow, 3, false);
            oTable.fnDraw();
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row', function (e) {
            e.preventDefault();
            if (newRow == false) {
                if (actualEditingRow) {
                    restoreRow(oTable, actualEditingRow);
                }
                newRow = true;
                var aiNew = oTable.fnAddData(['', '', '', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                actualEditingRow = nRow;
            }
        });
        $('#table-schedule-profiles').on('click', '.cancel-row', function (e) {

            e.preventDefault();
            if (newRow) {
                newRow = false;
                actualEditingRow = null;
                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);

            } else {
                restoreRow(oTable, actualEditingRow);
                actualEditingRow = null;
            }
        });
        $('#table-schedule-profiles').on('click', '.delete-row', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            bootbox.confirm("Are you sure to delete this row?", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.mockjax({
                        url: '/tabledata/delete/webservice',
                        dataType: 'json',
                        responseTime: 1000,
                        responseText: {
                            say: 'ok'
                        }
                    });
                    $.ajax({
                        url: '/tabledata/delete/webservice',
                        dataType: 'json',
                        success: function (json) {
                            $.unblockUI();
                            if (json.say == "ok") {
                                oTable.fnDeleteRow(nRow);
                            }
                        }
                    });

                }
            });


        });
        $('#table-schedule-profiles').on('click', '.save-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.mockjax({
                url: '/tabledata/add/webservice',
                dataType: 'json',
                responseTime: 1000,
                responseText: {
                    say: 'ok'
                }
            });
            $.ajax({
                url: '/tabledata/add/webservice',
                dataType: 'json',
                success: function (json) {
                    $.unblockUI();
                    if (json.say == "ok") {
                        saveRow(oTable, nRow);
                    }
                }
            });
        });
        $('#table-schedule-profiles').on('click', '.edit-row', function (e) {
            e.preventDefault();
            if (actualEditingRow) {
                if (newRow) {
                    oTable.fnDeleteRow(actualEditingRow);
                    newRow = false;
                } else {
                    restoreRow(oTable, actualEditingRow);

                }
            }
            var nRow = $(this).parents('tr')[0];
            editRow(oTable, nRow);
            actualEditingRow = nRow;

        });
        var oTable = $('#table-schedule-profiles').dataTable({
            "aoColumnDefs": [{
                "aTargets": [0]
            }],
            "oLanguage": {
                "sLengthMenu": "Show _MENU_ Rows",
                "sSearch": "",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            },
            "aaSorting": [[1, 'asc']],
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });
        $('#table-schedule-profiles_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-schedule-profiles_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-schedule-profiles_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-schedule-profiles_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
        });

        $('#create-new-profile').on('click', function (e) {
            e.preventDefault();

            var data = {
                'profile_name': $(this).parents('.form-group').find('#profile-name').val()
            };

            $.ajax({
                url: serverUrl + '/admin/school/set/schedule/profile/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    $.hideSubview();
                    if (data.status == "success") {
                        saveRowToProfileTable(oTable, data.result);
                        toastr.info("You Have successfully created this Schedule");
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
                    }
                }
            });
        });

        function saveRowToProfileTable(oTable, result) {

            var aiNew = oTable.fnAddData(['', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);

            //var jqInputs = $('input', nRow);
            oTable.fnUpdate(result.profile_name, nRow, 0, false);
            oTable.fnUpdate('<input type="radio" name="schedule_profile_make_current" class="flat-grey" id="schedule_profile_make_current">', nRow, 1, false);
            oTable.fnUpdate('<a href="#subview-add-new-schedule" class="show-sv show-schedules-row" data-startFrom="right">Schedules</a>', nRow, 2, false);
            oTable.fnDraw();
            nRow = nRow.setAttribute('data-profile-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        // To get All the school schedules from profile
        $('#table-schedule-profiles').on('click', '.show-schedules-row', function (e) {
            e.preventDefault();

            $('#schedule-tables').empty();

            var data = {
                'profile_id': $(this).parents('tr').attr('data-profile-id')
            }

            $.ajax({
                url: serverUrl + '/admin/school/get/schedule/by/profile/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    if (data.status == "success") {

                        $.subview({
                            content: "#subview-add-new-schedule",
                            startFrom: "right"
                        });

                        $('#subview-add-new-schedule').find('#schedule-profile-name').html(data.result.schedule_profile.profile_name);
                        $('#subview-add-new-schedule').find('#schedule-profile-name').attr('data-schedule-profile-id', data.result.schedule_profile.id);

                        for (var i = 0; i < data.result.school_schedules.length; i++) {

                            attachAllSchedules(data.result.school_schedules[i]);
                        }
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
                    }
                }
            });

        });

        function attachAllSchedules(result) {

            var table = '<table class="table" data-schedule-id="' + result.id + '"><thead><tr><td>Starts From (<strong id="start_from">' + result.start_from + '</strong>) To (<strong id="close_untill">' + result.close_untill + '</strong>)</td>' +
                '</tr></thead<tbody><tr><td>Opening Time: <strong id="opening_time">' + result.opening_time + '</strong></td><td>lunch Time: <strong id="lunch_time">' + result.lunch_time + '</strong></td>' +
                '<td>Closing Time: <strong id="closing_time">' + result.closing_time + '</strong></td><td><a href="#" id="#add-edit-schedule-timing">Edit' +
                '</a></td><td><a href="#" id="delete-schedule-timings">Delete</a></td></tr></tbody></table>';

            $('#schedule-tables').append(table);
        }


        $('#delete-schedule-timings').on('click', function (e) {

            e.preventDefault();
            console.log("agsdasdg");
        });

        $('#add-new-schedule-to-profile').on('click', function (e) {

            var schedule_profile_id = $('#subview-add-new-schedule').find('#schedule-profile-name').attr('data-schedule-profile-id');

            $.subview({
                content: "#subview-add-edit-schedule-timing",
                startFrom: "right"
            });
            $('#subview-add-edit-schedule-timing').find('#profile-schedule-id').val(schedule_profile_id);
        });

        $('#form-submit-new-schedule').on('click', function (e) {
            e.preventDefault();

            var data = {
                'schedule_profile_id': $('#subview-add-edit-schedule-timing').find('#profile-schedule-id').val(),
                'schedule_starts_from': $('#subview-add-edit-schedule-timing').find('#schedule-starts-from').val(),
                'schedule_ends_untill': $('#subview-add-edit-schedule-timing').find('#schedule-ends-untill').val(),
                'school_opening_time': $('#subview-add-edit-schedule-timing').find('#school-opening-time').val(),
                'school_lunch_time': $('#subview-add-edit-schedule-timing').find('#school-lunch-time').val(),
                'school_closing_time': $('#subview-add-edit-schedule-timing').find('#school-closing-time').val(),
            }

            $.ajax({
                url: serverUrl + '/admin/school/set/schedule/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    $.hideSubview();
                    if (data.status == "success") {
                        attachAllSchedules(data.result);
                        toastr.success('Congratulations. Schedule Successfully Created!!');
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
                    }
                }
            });
        });

        $('#delete-schedule-profile').on('click', function (e) {
            e.preventDefault();

            var data = {
                'profile_id': $('#subview-add-new-schedule').find('#schedule-profile-name').attr('data-schedule-profile-id')
            };

            bootbox.confirm("Are you sure , u want to delete this Profile?", function (result) {
                if (result) {

                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i>Please Wait a Little...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/school/delete/schedule/profile/post',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data, response) {
                            $.unblockUI();
                            if (data.status == "success") {
                                //delete Profile Table Row
                                oTable.fnDeleteRow($('#table-schedule-profiles').find('tr[data-profile-id="'+ data.result.id +'"]'));
                                $.hideSubview();
                                toastr.info("Successfully Deleted Profile!!!");
                            } else if (data.status == "failed") {
                                $.hideSubview();
                                toastr.warning(data.error.error_description);
                            }
                        }
                    });
                }
            });

        });

    };
    var makeScheduleProfileCurrent = function () {

        $('#table-schedule-profiles').on('click', '#schedule_profile_make_current', function (e) {
            e.preventDefault();

            var data = {
                'profile_id': $(this).parents('tr').attr('data-profile-id')
            };

            var input = $(this);
            bootbox.confirm("Are you sure , u want to make this Profile Current?", function (result) {
                if (result) {

                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/school/make/current/schedule/profile/post',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data, response) {
                            $.unblockUI();
                            if (data.status == "success") {
                                input.prop("checked", true);
                                toastr.info("This is Your Current Profile.");
                            } else if (data.status == "failed") {
                                toastr.warning(data.error.error_description);
                            }
                        }
                    });
                }
            });
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable_example2();
            makeScheduleProfileCurrent();
        }
    };
}();
