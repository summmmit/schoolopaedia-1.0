var TableDataSchoolStreams = function () {
    "use strict";

    var runDataTable_AddStreams = function () {

        var newRow = false;
        var actualEditingRow = null;

        $('#button-show-streams').on('click', function(e){
            e.preventDefault();
            oTable.fnClearTable();

            $('#table-add-streams').find('tbody').empty();
            $('#table-add-classes').find('tbody').empty();
            $('#table-add-sections').find('tbody').empty();
            $('#table-add-subjects').find('tbody').empty();

            $.ajax({
                url: serverUrl + '/admin/get/all/streams',
                dataType: 'json',
                method: 'POST',
                cache: false,
                success: function (data, response) {
                    for (var i = 0; i < data.result.length; i++) {
                        attachAllStreams(oTable, data.result[i]);
                    }
                }
            });
        });

        function attachAllStreams(oTable, result) {

            var aiNew = oTable.fnAddData(['', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0])

            nRow = nRow.setAttribute('data-stream-id', result.id);
            oTable.fnUpdate(result.stream_name, nRow, 0, false);
            oTable.fnUpdate('<a class="edit-row-streams" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete-row-streams" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
            newRow = false;
            actualEditingRow = null;
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
            jqTds[0].innerHTML = '<input type="text" class="form-control" id="new-input" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="save-row-streams" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel-row-streams" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(result.stream_name, nRow, 0, false);
            oTable.fnUpdate('<a class="edit-row-streams" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete-row-streams" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
            nRow = nRow.setAttribute('data-stream-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-streams', function (e) {
            e.preventDefault();
            if (newRow == false) {
                if (actualEditingRow) {
                    restoreRow(oTable, actualEditingRow);
                }
                newRow = true;
                var aiNew = oTable.fnAddData(['', '', '']);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                actualEditingRow = nRow;
            }
        });
        $('#table-add-streams').on('click', '.cancel-row-streams', function (e) {
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
            oTable.parentsUntil(".panel").find(".errorHandler").addClass("no-display");
        });
        $('#table-add-streams').on('click', '.delete-row-streams', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parents('tr').attr('data-stream-id');

            var data = {
                stream_id: id
            };

            bootbox.confirm("Are you sure to delete this row? If you Delete it, Classes , Subjects and Sections associated with it will also get delete.", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/delete/stream',
                        dataType: 'json',
                        method: 'POST',
                        cache: false,
                        data: data,
                        success: function (data, response) {
                            $.unblockUI();
                            if(data.status == "success"){
                                oTable.fnDeleteRow(nRow);
                                toastr.success('You have deleted Stream : ' + data.result.stream_name + ' and Classes , Subjects and Sections associated with it.');
                            } else if (data.status == "failed") {
                                toastr.warning(data.error.error_description);
                            }
                        }
                    });

                }
            });


        });
        $('#table-add-streams').on('click', '.save-row-streams', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                stream_name: $(this).parents('tr').find('#new-input').val(),
                stream_id: $(this).parents('tr').attr('data-stream-id')
            };
            console.log(data);

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl + '/admin/add/or/edit/stream',
                dataType: 'json',
                method: 'POST',
                cache: false,
                data: data,
                success: function (data, response) {
                    $.unblockUI();
                    console.log(data);
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.result);
                        toastr.info('You have Successfully Edited Stream: ' + data.result.stream_name);
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
                    }
                }
            });
        });
        $('#table-add-streams').on('click', '.edit-row-streams', function (e) {
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
        var oTable = $('#table-add-streams').dataTable({
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
        $('#table-add-streams_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-add-streams_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-add-streams_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-add-streams_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable_AddStreams();
        }
    };
}();
