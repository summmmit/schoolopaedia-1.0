var TableDataSchoolSessions = function () {
    "use strict";
    var runDataTable_example2 = function () {
        var newRow = false;
        var actualEditingRow = null;

        $.ajax({
            url: serverUrl + '/admin/get/all/sessions/post',
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if(data.status == "success"){
                    for(var i=0; i < data.result.length; i++){
                        attachAllSessions(oTable, data.result[i]);
                    }
                }
            }
        });

        function attachAllSessions(oTable, result){

            var aiNew = oTable.fnAddData(['', '', '', '', '']);
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
            jqTds[0].innerHTML = '<input type="text" name="session_start_from" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" name="end_session_untill" class="form-control" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="radio" name="session_make_current" id="session_make_current" disabled>';

            jqTds[3].innerHTML = '<a class="save-session-row" href="">Save</a>';
            jqTds[4].innerHTML = '<a class="cancel-session-row" href="">Cancel</a>';


            $('input[type="text"]').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

        }

        function saveRow(oTable, nRow, result) {
            oTable.fnUpdate(result.session_start, nRow, 0, false);
            oTable.fnUpdate(result.session_end, nRow, 1, false);
            if(result.current_session){
                oTable.fnUpdate('<input type="radio" name="session_make_current" id="session_make_current" checked>', nRow, 2, false);
            }else{
                oTable.fnUpdate('<input type="radio" name="session_make_current" id="session_make_current">', nRow, 2, false);
            }
            oTable.fnUpdate('<a class="edit-session-row" href="#">Edit</a>', nRow, 3, false);
            oTable.fnUpdate('<a class="delete-session-row" href="#">Delete</a>', nRow, 4, false);
            oTable.fnDraw();

            nRow = nRow.setAttribute('data-school-session-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-new-session-row', function (e) {
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
        $('#table-school-sessions').on('click', '.cancel-session-row', function (e) {

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
        $('#table-school-sessions').on('click', '.delete-session-row', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];

            var data = {
                'session_id' : $(this).parents('tr').attr('data-school-session-id')
            }

            bootbox.confirm("Are you sure to delete this row?", function (result) {

                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/delete/session',
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (data) {
                            $.unblockUI();
                            if (data.status == "success") {
                                oTable.fnDeleteRow(nRow);
                                toastr.info('You have successfully Deleted Section');
                            } else if (data.status == "failed") {
                                toastr.warning(data.error.error_description);
                            }
                        }
                    });
                }
            });
        });

        $('#table-school-sessions').on('click', '.save-session-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                'start_session_from' : $('input[name="session_start_from"]').val(),
                'end_session_untill' : $('input[name="end_session_untill"]').val(),
                'school_session_id' : $(this).parents('tr').attr('data-school-session-id')
            }

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            $.ajax({
                url: serverUrl + '/admin/create/or/edit/session/post',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.result);
                        toastr.info('You have successfully Created new Section');
                    } else if (data.status == "failed") {
                        toastr.info(data.error.error_description);
                    }
                }
            });
        });
        $('#table-school-sessions').on('click', '.edit-session-row', function (e) {
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
        var oTable = $('#table-school-sessions').dataTable({
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
        $('#table-school-sessions_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-school-sessions_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-school-sessions_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-school-sessions_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
        });
    };
    var makeScheduleSessionCurrent = function () {

        $('#table-school-sessions').on('click', '#session_make_current', function (e) {
            e.preventDefault();

            var data = {
                'session_id': $(this).parents('tr').attr('data-school-session-id')
            };

            var input = $(this);
            bootbox.confirm("Are you sure , u want to make this Profile Current?", function (result) {
                if (result) {

                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/make/session/current',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data, response) {
                            $.unblockUI();
                            if (data.status == "success") {
                                input.prop("checked", true);
                                toastr.info(data.description);
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
            makeScheduleSessionCurrent();
        }
    };
}();
