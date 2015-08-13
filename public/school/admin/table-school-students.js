var TableSchoolStudents = function() {
    "use strict";
    
    var runDataTable_AddClasses = function() {
        var newRow = false;
        var actualEditingRow = null;

        function restoreRow(cTable, nRow) {
            var aData = cTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                cTable.fnUpdate(aData[i], nRow, i, false);
            }

            cTable.fnDraw();
        }

        function editRow(cTable, nRow) {
            var aData = cTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" class="form-control" id="new-input" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<select class="streams-drop-down form-control"><option>Choose an Stream...</option></select>';
            jqTds[2].innerHTML = '<a class="save-row-classes" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row-classes" href="">Cancel</a>';
            $.ajax({
                url: 'http://localhost/projects/schools/public/administrator/admin/time/table/get/streams',
                dataType: 'json',
                method: 'POST',
                success: function(data, response) {
                    var DropdownClass = cTable.find(".streams-drop-down");
                    var DropdownId = cTable.find(".streams-drop-down").parent().attr('id');
                    var i;
                    for (i = 0; i < data.streams.length; i++) {
                        if (DropdownId == data.streams[i].id) {
                            DropdownClass.append('<option value="' + data.streams[i].id + '" selected>' + data.streams[i].stream_name + '</option>');
                        } else {
                            DropdownClass.append('<option value="' + data.streams[i].id + '">' + data.streams[i].stream_name + '</option>');
                        }
                    }
                }
            });

        }

        function saveRow(cTable, nRow, dataId, streamId, streamName) {
            var jqInputs = $('input', nRow);
            $('select', nRow).parent().attr('id', streamId);
            var isExistsId = nRow.getAttribute('id');
            if (isExistsId === null) {
                nRow = nRow.setAttribute('id', dataId);
            }
            cTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            cTable.fnUpdate(streamName, nRow, 1, false);
            cTable.fnUpdate('<a class="edit-row-classes" href="">Edit</a>', nRow, 2, false);
            cTable.fnUpdate('<a class="delete-row-classes" href="">Delete</a>', nRow, 3, false);
            cTable.fnDraw();
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-classes', function(e) {
            e.preventDefault();
            if (newRow == false) {
                if (actualEditingRow) {
                    restoreRow(cTable, actualEditingRow);
                }
                newRow = true;
                var aiNew = cTable.fnAddData(['', '', '', '']);
                var nRow = cTable.fnGetNodes(aiNew[0]);
                editRow(cTable, nRow);
                actualEditingRow = nRow;
            }
        });
        $('#table-school-students').on('click', '.cancel-row-classes', function(e) {
            e.preventDefault();
            if (newRow) {
                newRow = false;
                actualEditingRow = null;
                var nRow = $(this).parents('tr')[0];
                cTable.fnDeleteRow(nRow);

            } else {
                restoreRow(cTable, actualEditingRow);
                actualEditingRow = null;
            }
            cTable.parentsUntil(".panel").find(".errorHandler").addClass("no-display");
        });
        $('#table-school-students').on('click', '.delete-row-classes', function(e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                cTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            var class_name = $(this).parents('tr').find('td').first().text();
            var class_id = $(this).parents('tr').attr('id');
            var stream_id = $(this).parents('tr').find(".sorting_1").attr('id');
            var data = {
                class_name: class_name,
                class_id: class_id,
                stream_id: stream_id
            };

            bootbox.confirm("Are you sure to delete this row?", function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: 'http://localhost/projects/schools/public/administrator/admin/time/table/delete/classes',
                        dataType: 'json',
                        cache: false,
                        method: 'POST',
                        data: data,
                        success: function(data, response) {
                            $.unblockUI();
                            toastr.success('You have deleted Class : ' + class_name + ' and Subjects and Sections associated with it.');
                            cTable.fnDeleteRow(nRow);
                        }
                    });

                }
            });



        });
        $('#table-school-students').on('click', '.save-row-classes', function(e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var class_name = $(this).parents('tr').find('#new-input').val();
            var class_id = $(this).parents('tr').attr('id');
            var stream_id = $(this).parents('tr').find("select").val();
            var data = {
                class_name: class_name,
                class_id: class_id,
                stream_id: stream_id
            };
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: 'http://localhost/projects/schools/public/administrator/admin/time/table/add/classes',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: data,
                success: function(data, response) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(cTable, nRow, data.data_send.id, data.data_send.streams_id, data.data_send.streams_name);
                        toastr.info('You Have successfully added class :' + class_name);
                    } else if (data.status == "failed") {
                        cTable.parentsUntil(".panel").find(".errorHandler").removeClass("no-display").html('<p class="help-block alert-danger">' + data.error_messages.class_name + '</p>');
                    }
                }
            });
        });
        $('#table-school-students').on('click', '.edit-row-classes', function(e) {
            e.preventDefault();
            if (actualEditingRow) {
                if (newRow) {
                    cTable.fnDeleteRow(actualEditingRow);
                    newRow = false;
                } else {
                    restoreRow(cTable, actualEditingRow);

                }
            }
            var nRow = $(this).parents('tr')[0];

            editRow(cTable, nRow);
            actualEditingRow = nRow;

        });
        var cTable = $('#table-school-students').dataTable({
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
        $('#table-school-students_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-school-students_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-school-students_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-school-students_column_toggler input[type="checkbox"]').change(function() {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = cTable.fnSettings().aoColumns[iCol].bVisible;
            cTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function() {
            runDataTable_AddClasses();
        }
    };
}();
