var TableDataSchoolSchedule = function () {
    "use strict";
    var schoolScheduleProfileTable = function () {

        // fetch all the Profiles
        $.ajax({
            url: serverUrl + '/admin/school/get/all/schedule/profile/post',
            dataType: 'json',
            method: 'POST',
            success: function (data, response) {
                if (data.status == "success") {
                    for (var i = 0; i < data.result.length; i++) {
                        attachAllProfiles(data.result[i]);
                    }
                } else if (data.status == "failed") {
                    toastr.warning(data.error.error_description);
                }
            }
        });

        function attachAllProfiles(result) {

            var aiNew = oTable.fnAddData(['', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);

            var profile_name_column = '<a href="#subview-add-new-schedule" class="show-sv" data-startFrom="right">'+
                result.profile_name +'</a>';

            oTable.fnUpdate(profile_name_column, nRow, 0, false);

            if(result.current_profile == 1){
                var column = '<div class="checkbox-table"><label>' +
                    '<input type="radio" checked name="schedule_profile_make_current" class="flat-grey foocheck" id="schedule_profile_make_current">' +
                    '</label></div>';
            }else if(result.current_profile == 0){
                var column = '<div class="checkbox-table"><label>' +
                    '<input type="radio" name="schedule_profile_make_current" class="flat-grey foocheck" id="schedule_profile_make_current">' +
                    '</label></div>';
            }

            oTable.fnUpdate(column, nRow, 1, false);
            oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="delete-row" href="">Delete</a>', nRow, 3, false);
            nRow = nRow.setAttribute('data-profile-id', result.id);
            oTable.fnDraw();
        }


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
            jqTds[0].innerHTML = '<input type="text" name="profile_name" class="form-control" value="' + aData[0] + '">';

            var column = '<div class="checkbox-table"><label>' +
                '<input type="radio" disabled name="schedule_profile_make_current" class="flat-grey foocheck" id="schedule_profile_make_current">' +
                '</label></div>';
            jqTds[1].innerHTML = column;

            jqTds[2].innerHTML = '<a class="save-row" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(result.profile_name, nRow, 0, false);

            if(result.current_profile == 1){
                var column = '<div class="checkbox-table"><label>' +
                    '<input type="radio" checked name="schedule_profile_make_current" class="flat-grey foocheck" id="schedule_profile_make_current">' +
                    '</label></div>';
            }else if(result.current_profile == 0){
                var column = '<div class="checkbox-table"><label>' +
                    '<input type="radio" name="schedule_profile_make_current" class="flat-grey foocheck" id="schedule_profile_make_current">' +
                    '</label></div>';
            }
            oTable.fnUpdate(column, nRow, 1, false);
            oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="delete-row" href="">Delete</a>', nRow, 3, false);
            nRow = nRow.setAttribute('data-profile-id', result.id);
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
        $('#table-schedule-profiles').on('click', '.delete-row', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];

            var data = {
                'profile_id': $(this).parents('tr').attr('data-profile-id')
            };
            bootbox.confirm("Are you sure to delete this row?", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });

                    $.ajax({
                        url: serverUrl + '/admin/school/delete/schedule/profile/post',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data, response) {
                            $.unblockUI();
                            if (data.status == "success") {
                                oTable.fnDeleteRow(nRow);
                                toastr.success('This Profile Has Been Deleted Successfully');
                            } else if (data.status == "failed") {
                                toastr.warning(data.error.error_description);
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

            var data = {
                'profile_name': $('input[name="profile_name"]').val(),
                'profile_id': $(this).parents('tr').attr('data-profile-id')
            };

            $.ajax({
                url: serverUrl + '/admin/school/set/schedule/profile/post',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data, response) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.result);
                        toastr.info("You Have successfully created this Schedule");
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
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
            "aaSorting": [[0, 'asc']],
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 5,
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

    var makeScheduleProfileCurrent = function(){

        $('#table-schedule-profiles').on('click', '#schedule_profile_make_current', function (e) {
            e.preventDefault();

            var data = {
                'profile_id': $(this).parents('tr').attr('data-profile-id')
            };

            var input = $(this);
            bootbox.confirm("Are you sure , u want to make this Profile Current?", function (result) {
                if(result){

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
    }
    return {
        //main function to initiate template pages
        init: function () {
            schoolScheduleProfileTable();
            makeScheduleProfileCurrent();
        }
    };
}();
