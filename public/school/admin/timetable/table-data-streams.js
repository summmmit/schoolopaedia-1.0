var TableDataStreams = function() {
    "use strict";
    
    var runDataTable_AddStreams = function() {
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
            jqTds[0].innerHTML = '<input type="text" class="form-control" id="new-input" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="save-row-streams" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel-row-streams" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, dataId) {
            var jqInputs = $('input', nRow);
            var isExistsId = nRow.getAttribute('id');
            if (isExistsId === null) {
                nRow = nRow.setAttribute('id', dataId);
            }
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit-row-streams" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete-row-streams" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-streams', function(e) {
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
        $('#table-add-streams').on('click', '.cancel-row-streams', function(e) {
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
        $('#table-add-streams').on('click', '.delete-row-streams', function(e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parents('tr').attr('id');
            var stream_name = $(this).parent().prev().prev().text();

            var data = {
                stream_id: id,
                stream_name: stream_name
            };

            bootbox.confirm("Are you sure to delete this row? If you Delete it, Classes , Subjects and Sections associated with it will also get delete.", function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl+'/admin/time/table/delete/stream',
                        dataType: 'json',
                        method: 'POST',
                        cache: false,
                        data: data,
                        success: function(data, response) {
                            $.unblockUI();
                            oTable.fnDeleteRow(nRow);
                            var cTableRows = $('#table-add-classes').find(".sorting_1").parent().parent().find('td[id="' + data.deleted_item_id + '"]').parent();
                            var i;
                            for (i = 0; i < cTableRows.length; i++) {
                                cTableRows[i].remove();
                            }
                            toastr.success('You have deleted Stream : ' + stream_name + ' and Classes , Subjects and Sections associated with it.');

                            location.reload();

                        }
                    });

                }
            });



        });
        $('#table-add-streams').on('click', '.save-row-streams', function(e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var stream_name = $(this).parents('tr').find('#new-input').val();
            var stream_id = $(this).parents('tr').attr('id');
            var data = {
                stream_name: stream_name,
                stream_id: stream_id
            };
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl+'/admin/time/table/add/stream',
                dataType: 'json',
                method: 'POST',
                cache: false,
                data: data,
                success: function(data, response) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.data_send.id);
                        toastr.info('You have successfully Created new stream: ' + stream_name);
                    } else if (data.status == "failed") {
                        oTable.parentsUntil(".panel").find(".errorHandler").removeClass("no-display").html('<p class="help-block alert-danger">' + data.error_messages.stream_name + '</p>');
                    }
                }
            });
        });
        $('#table-add-streams').on('click', '.edit-row-streams', function(e) {
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
        $('#table-add-streams_column_toggler input[type="checkbox"]').change(function() {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function() {
            runDataTable_AddStreams();
        }
    };
}();
