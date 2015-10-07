var TableDataScheduleProfiles = function () {
    "use strict";

    var runDataTable_ScheduleProfiles = function () {
        var newRow = false;
        var actualEditingRow = null;

        $.ajax({
            url: serverUrl + '/admin/school/get/all/schedule/profile/post',
            dataType: 'json',
            method: 'POST',
            success: function (data, response) {
                console.log(data);
                if (data.status == "success") {
                    for (var i = 0; i < data.result.length; i++) {
                        attachAllScheduleProfiles(data.result[i]);
                    }
                } else if (data.status == "failed") {
                    toastr.warning(data.error.error_description);
                }
            }
        });

        function attachAllScheduleProfiles(result) {

            var aiNew = oTable.fnAddData(['', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            saveRow(oTable, nRow, result);
        }

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
            jqTds[0].innerHTML = '<input type="text" name="schedule_profile_name" id="schedule_profile_name" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="radio" name="schedule_profile_make_current" id="schedule_profile_make_current" disabled>';

            jqTds[2].innerHTML = '<a class="save-row" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(result.profile_name, nRow, 0, false);
            if (result.current_profile) {
                oTable.fnUpdate('<input type="radio" name="schedule_profile_make_current" id="schedule_profile_make_current" checked>', nRow, 1, false);
            } else {
                oTable.fnUpdate('<input type="radio" name="schedule_profile_make_current" id="schedule_profile_make_current">', nRow, 1, false);
            }
            oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="show-schedules-row" href="">Schedules</a>', nRow, 3, false);
            oTable.fnDraw();
            nRow = nRow.setAttribute('data-schedule-profile-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-new-profile-row', function (e) {
            e.preventDefault();
            if (newRow == false) {
                if (actualEditingRow) {
                    restoreRow(oTable, actualEditingRow);
                }
                newRow = true;
                var aiNew = oTable.fnAddData(['', '', '', '']);
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

        $('#subview-schedules').on('click', '#delete-schedule-profile', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            var profile_id = $('#subview-schedules').find('#profile-heading').attr('data-profile-schedule-id');
            var nRow = $('#table-schedule-profiles').find('tr[data-schedule-profile-id="'+ profile_id +'"]')[0];

            var data = {
                'profile_id': profile_id,
            }

            bootbox.confirm("Are you sure to delete this Profile? All the Schedules will be deleted too.", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });

                    $.ajax({
                        url: serverUrl + '/admin/school/delete/schedule/profile/post',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data) {
                            $.unblockUI();
                            if (data.status === "success") {
                                oTable.fnDeleteRow(nRow);
                                toastr.success('You have successfully deleted Schedule Profile !!');
                            }else if(data.status == "failed"){
                                toastr.warning(data.error.error_description);
                            }
                            $.hideSubview();
                        },
                        error: function (data) {
                            $.unblockUI();
                            console.log(data);
                        }
                    });
                }
            });
        });

        $('#table-schedule-profiles').on('click', '.save-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                profile_id: $(this).parents('tr').attr('data-schedule-profile-id'),
                profile_name: $(this).parents('tr').find('#schedule_profile_name').val(),
            }

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            $.ajax({
                url: serverUrl + '/admin/edit/set/schedule/profile/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data) {
                    $.unblockUI();
                    if (data.status === "success") {
                        saveRow(oTable, nRow, data.result);
                    }
                },
                error: function (data) {
                    $.unblockUI();
                    console.log(data);
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

        $('#table-schedule-profiles').on('click', '#schedule_profile_make_current', function (e) {
            e.preventDefault();

            var data = {
                'profile_id': $(this).parents('tr').attr('data-schedule-profile-id')
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
            "aaSorting": [[0, 'asc']],
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
    };

    var runDataTable_Schedules = function () {
        var newRow = false;
        var actualEditingRow = null;

        $('#table-schedule-profiles').on('click', '.show-schedules-row', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            var schedule_profile_id = $(this).parents('tr').attr('data-schedule-profile-id');

            var data = {
                profile_id : schedule_profile_id
            }
            $.ajax({
                url: serverUrl + '/admin/get/all/schedules/by/profile/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    console.log(data);
                    if (data.status == "success") {

                        attachScheduleProfile(data.result.schedule_profile);
                        for (var i = 0; i < data.result.school_schedules.length; i++) {
                            attachAllSchedules(data.result.school_schedules[i]);
                        }

                        $.subview({
                            content: "#subview-schedules",
                            startFrom: "right"
                        });
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
                    }
                }
            });

        });

        function attachAllSchedules(result) {

            var aiNew = oTable.fnAddData(['', '', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            saveRow(oTable, nRow, result);
        }

        function attachScheduleProfile(result){
            $('#subview-schedules').find('#profile-heading').attr('data-profile-schedule-id', result.id);
            $('#subview-schedules').find('#profile-schedule-name').text(' ' + result.profile_name);
        }

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
            if(aData[0]){
                aData[0] = moment(aData[0], "ll").format('YYYY-MM-DD');
            }else{
                aData[0] = '';
            }
            if(aData[1]){
                aData[1] = moment(aData[1], "ll").format('YYYY-MM-DD');
            }else{
                aData[1] = '';
            }
            jqTds[0].innerHTML = '<input type="text" name="start_from" id="start_from" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" name="close_untill" id="close_untill" class="form-control" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" name="opening_time" data-format="HH:mm" data-template="HH : mm" id="opening_time" class="form-control" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" name="lunch_time" data-format="HH:mm" data-template="HH : mm" id="lunch_time" class="form-control" value="' + aData[3] + '">';
            jqTds[4].innerHTML = '<input type="text" name="closing_time" data-format="HH:mm" data-template="HH : mm" id="closing_time" class="form-control" value="' + aData[4] + '">';

            jqTds[5].innerHTML = '<a class="save-row" href="">Save</a>';
            jqTds[6].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

            $('input[id="opening_time"], input[id="lunch_time"], input[id="closing_time"]').each(function() {
                $(this).combodate({
                    firstItem: 'none', //show 'hour' and 'minute' string at first item of dropdown
                    minuteStep: 5,
                });
            });
            $('#start_from, #close_untill').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(moment(result.start_from, "YYYY-MM-DD").format("ll"), nRow, 0, false);
            oTable.fnUpdate(moment(result.close_untill, "YYYY-MM-DD").format("ll"), nRow, 1, false);
            oTable.fnUpdate(moment(result.opening_time, "hh:mm").format("hh:mm A"), nRow, 2, false);
            oTable.fnUpdate(moment(result.lunch_time, "hh:mm").format("hh:mm A"), nRow, 3, false);
            oTable.fnUpdate(moment(result.closing_time, "hh:mm").format("hh:mm A"), nRow, 4, false);
            oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 5, false);
            oTable.fnUpdate('<a class="delete-row" href="">Delete</a>', nRow, 6, false);
            oTable.fnDraw();
            nRow = nRow.setAttribute('data-schedule-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-new-schedule-row', function (e) {
            e.preventDefault();
            if (newRow == false) {
                if (actualEditingRow) {
                    restoreRow(oTable, actualEditingRow);
                }
                newRow = true;
                var aiNew = oTable.fnAddData(['', '', '', '', '', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                actualEditingRow = nRow;
            }
        });

        $('#table-schedules').on('click', '.cancel-row', function (e) {

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

        $('#table-schedules').on('click', '.delete-row', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];

            var data = {
                'schedule_id': $(this).closest('tr').attr('data-schedule-id'),
            }

            bootbox.confirm("Are you sure to delete this row?", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });

                    $.ajax({
                        url: serverUrl + '/admin/delete/schedule/post',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data) {
                            $.unblockUI();
                            if (data.status === "success") {
                                oTable.fnDeleteRow(nRow);
                                toastr.success('You have successfully deleted Schedule !!');
                            }else if(data.status == "failed"){
                                toastr.warning(data.error.error_description);
                            }
                        },
                        error: function (data) {
                            $.unblockUI();
                            console.log(data);
                        }
                    });
                }
            });
        });

        $('#table-schedules').on('click', '.save-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                'schedule_profile_id': $('#subview-schedules').find('#profile-heading').attr('data-profile-schedule-id'),
                'schedule_starts_from': $(this).closest('tr').find('#start_from').val(),
                'schedule_ends_untill': $(this).closest('tr').find('#close_untill').val(),
                'school_opening_time': $(this).parents('tr').find('input[name="opening_time"]').val(),
                'school_lunch_time': $(this).closest('tr').find('#lunch_time').val(),
                'school_closing_time': $(this).closest('tr').find('#closing_time').val(),
                'schedule_id': $(this).closest('tr').attr('data-schedule-id'),
            }

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            $.ajax({
                url: serverUrl + '/admin/edit/set/schedule/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data) {
                    $.unblockUI();
                    if (data.status === "success") {
                        saveRow(oTable, nRow, data.result);
                        toastr.success('You have successfully created or edited a Schedule !!');
                    }else if(data.status == "failed"){
                        toastr.warning(data.error.error_description);
                    }
                },
                error: function (data) {
                    $.unblockUI();
                    console.log(data);
                }
            });
        });

        $('#table-schedules').on('click', '.edit-row', function (e) {
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

        var oTable = $('#table-schedules').dataTable({
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
            "aaSorting": [[0, 'asc']],
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });

        $('#table-schedules_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-schedules_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-schedules_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-schedules_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable_ScheduleProfiles();
            runDataTable_Schedules();
        }
    };
}();
