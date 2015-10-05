var TableDataPeriodsAndProfiles = function () {
    "use strict";
    var runDataTable_example2 = function () {
        var newRow = false;
        var actualEditingRow = null;

        $.ajax({
            url: serverUrl + '/admin/get/all/period/profiles',
            dataType: 'json',
            method: 'POST',
            success: function (data) {
                if (data.status === "success") {
                    for (var i = 0; i < data.result.length; i++) {
                        attachAllPeriodProfiles(data.result[i]);
                    }
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

        function attachAllPeriodProfiles(result) {

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
            jqTds[0].innerHTML = '<input type="text" name="period_profile_name" id="period_profile_name" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="radio" name="period_profile_make_current" id="period_profile_make_current" disabled>';

            jqTds[2].innerHTML = '<a class="save-row" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(result.profile_name, nRow, 0, false);
            if (result.current_profile) {
                console.log(result.current_profile);
                oTable.fnUpdate('<input type="radio" name="period_profile_make_current" id="period_profile_make_current" checked>', nRow, 1, false);
            } else {
                oTable.fnUpdate('<input type="radio" name="period_profile_make_current" id="period_profile_make_current">', nRow, 1, false);
            }
            oTable.fnUpdate('<a class="edit-period-profile-row" href="#">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="detail-period-profile-row" id="detail-period-profile-row" href="#">Details</a>', nRow, 3, false);
            oTable.fnDraw();

            nRow = nRow.setAttribute('data-period-profile-id', result.id);

            newRow = false;
            actualEditingRow = null;
        }


        $('#table-periods-profile').on('click', '#period_profile_make_current', function (e) {
            e.preventDefault();

            var data = {
                period_profile_id : $(this).parents('tr').attr('data-period-profile-id')
            }

            var input = $(this);
            bootbox.confirm("Are you sure to make it current profile?", function (result) {
                if (result) {

                    $.ajax({
                        url: serverUrl + '/admin/make/current/period/profiles',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data) {
                            if (data.status === "success") {
                                input.prop("checked", true);
                                toastr.success('You have successfully make this profile current');
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });
        });

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

        $('#table-periods-profile').on('click', '.cancel-row', function (e) {

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

        $('#table-periods-profile').on('click', '.delete-row', function (e) {
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

        $('#table-periods-profile').on('click', '.save-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                period_profile_id : $(this).parents('tr').attr('data-period-profile-id'),
                period_profile_name : $(this).parents('tr').find('#period_profile_name').val(),
            }

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            $.ajax({
                url: serverUrl + '/admin/edit/create/period/profiles',
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

        $('#table-periods-profile').on('click', '#detail-period-profile-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                period_profile_id : $(this).parents('tr').attr('data-period-profile-id')
            }

            $.ajax({
                url: serverUrl + '/admin/get/period/profiles/by/id',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data) {
                    $.unblockUI();
                    if (data.status === "success") {

                        $.subview({
                            content: "#subview-periods",
                            startFrom: "right"
                        });

                        $('#subview-periods').find('#period-profile-name').text(" " + data.result.profile_name);
                        $('#subview-periods').find('#period-profile-name').attr('data-profile-period-id', data.result.id);
                    }
                },
                error: function (data) {
                    $.unblockUI();
                    console.log(data);
                }
            });
        });

        $('#table-periods-profile').on('click', '.edit-period-profile-row', function (e) {
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

        var oTable = $('#table-periods-profile').dataTable({
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

        $('#table-periods-profile_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-periods-profile_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-periods-profile_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-periods-profile_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
        });
    };
    var runDataTable_Periods = function () {
        var newRow = false;
        var actualEditingRow = null;

        function attachAllPeriods(result) {

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
            jqTds[0].innerHTML = '<input type="text" name="period_profile_name" id="period_profile_name" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="radio" name="period_profile_make_current" id="period_profile_make_current" disabled>';

            jqTds[2].innerHTML = '<a class="save-row" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(result.profile_name, nRow, 0, false);
            if (result.current_profile) {
                console.log(result.current_profile);
                oTable.fnUpdate('<input type="radio" name="period_profile_make_current" id="period_profile_make_current" checked>', nRow, 1, false);
            } else {
                oTable.fnUpdate('<input type="radio" name="period_profile_make_current" id="period_profile_make_current">', nRow, 1, false);
            }
            oTable.fnUpdate('<a class="edit-period-profile-row" href="#">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="detail-period-profile-row" id="detail-period-profile-row" href="#">Details</a>', nRow, 3, false);
            oTable.fnDraw();

            nRow = nRow.setAttribute('data-period-profile-id', result.id);

            newRow = false;
            actualEditingRow = null;
        }


        $('#table-periods').on('click', '#period_profile_make_current', function (e) {
            e.preventDefault();

            var data = {
                period_profile_id : $(this).parents('tr').attr('data-period-profile-id')
            }

            var input = $(this);
            bootbox.confirm("Are you sure to make it current profile?", function (result) {
                if (result) {

                    $.ajax({
                        url: serverUrl + '/admin/make/current/period/profiles',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function (data) {
                            if (data.status === "success") {
                                input.prop("checked", true);
                                toastr.success('You have successfully make this profile current');
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });
        });

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

        $('#table-periods').on('click', '.cancel-row', function (e) {

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

        $('#table-periods').on('click', '.delete-row', function (e) {
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

        $('#table-periods').on('click', '.save-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                period_profile_id : $(this).parents('tr').attr('data-period-profile-id'),
                period_profile_name : $(this).parents('tr').find('#period_profile_name').val(),
            }

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            $.ajax({
                url: serverUrl + '/admin/edit/create/period/profiles',
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

        $('#table-periods').on('click', '#detail-period-profile-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                period_profile_id : $(this).parents('tr').attr('data-period-profile-id')
            }

            $.ajax({
                url: serverUrl + '/admin/get/period/profiles/by/id',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function (data) {
                    $.unblockUI();
                    if (data.status === "success") {

                        $.subview({
                            content: "#subview-periods",
                            startFrom: "right"
                        });

                        console.log(data);

                        $('#subview-periods').find('#period-profile-name').text(" " + data.result.profile_name);
                        $('#subview-periods').find('#period-profile-name').attr('data-profile-period-id', data.result.id);
                    }
                },
                error: function (data) {
                    $.unblockUI();
                    console.log(data);
                }
            });
        });

        $('#table-periods').on('click', '.edit-period-profile-row', function (e) {
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
        var oTable = $('#table-periods').dataTable({
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
        $('#table-periods_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-periods_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-periods_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-periods_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable_example2();
            runDataTable_Periods();
        }
    };
}();
