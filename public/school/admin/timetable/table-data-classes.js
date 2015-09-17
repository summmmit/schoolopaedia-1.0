var TableDataClasses = function () {
    "use strict";

    var runDataTable_AddClasses = function () {
        var newRow = false;
        var actualEditingRow = null;

        $('#button-show-classes').on('click', function (e) {
            e.preventDefault();
            cTable.fnClearTable();

            $('#subview-add-classes').find('#form-field-select-classes-streams');

            $.ajax({
                url: serverUrl + '/admin/get/all/streams',
                dataType: 'json',
                method: 'POST',
                success: function (data, response) {
                    for (var i = 0; i < data.result.length; i++) {
                        attachAllStreamsToDropDown(data.result[i]);
                    }
                }
            });
        });

        function attachAllStreamsToDropDown(result) {

            $('#subview-add-classes').find('#form-field-select-classes-streams')
                .append('<option value="' + result.id + '">' + result.stream_name + '</option>');
        }

        $('#form-field-select-classes-streams').on('change', function (e) {
            e.preventDefault();
            cTable.fnClearTable();

            var stream_id = $(this).val();

            if(stream_id){
                $('#button-add-row-classes').removeClass('no-display');
                $('#classes-table').removeClass('no-display');

                var data = {
                    'stream_id': stream_id
                }

                $.ajax({
                    url: serverUrl + '/admin/get/all/classes/by/stream/id',
                    dataType: 'json',
                    method: 'POST',
                    data: data,
                    success: function (data, response) {
                        for (var i = 0; data.result.length > 0 && i < data.result.length ; i++) {
                            attachAllClasses(cTable, data.result[i]);
                        }
                    }
                });
            }else{
                $('#button-add-row-classes').addClass('no-display');
                $('#classes-table').addClass('no-display');
            }
        });

        function attachAllClasses(cTable, result) {

            var aiNew = cTable.fnAddData(['', '', '']);
            var nRow = cTable.fnGetNodes(aiNew[0]);

            saveRow(cTable, nRow, result);
        }

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
            jqTds[1].innerHTML = '<a class="save-row-classes" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel-row-classes" href="">Cancel</a>';
        }

        function saveRow(cTable, nRow, result) {

            cTable.fnUpdate(result.class_name, nRow, 0, false);
            cTable.fnUpdate('<a class="edit-row-classes" href="">Edit</a>', nRow, 1, false);
            cTable.fnUpdate('<a class="delete-row-classes" href="">Delete</a>', nRow, 2, false);
            cTable.fnDraw();
            nRow = nRow.setAttribute('data-class-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-classes', function (e) {
            e.preventDefault();
            if (newRow == false) {
                if (actualEditingRow) {
                    restoreRow(cTable, actualEditingRow);
                }
                newRow = true;
                var aiNew = cTable.fnAddData(['', '', '']);
                var nRow = cTable.fnGetNodes(aiNew[0]);
                editRow(cTable, nRow);
                actualEditingRow = nRow;
            }
        });
        $('#table-add-classes').on('click', '.cancel-row-classes', function (e) {
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
        $('#table-add-classes').on('click', '.delete-row-classes', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                cTable.fnDeleteRow(actualEditingRow);
                newRow = false;
            }
            var nRow = $(this).parents('tr')[0];
            var class_id = $(this).parents('tr').attr('data-class-id');

            var data = {
                class_id: class_id,
            };

            bootbox.confirm("Are you sure to delete this row?", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/delete/class',
                        dataType: 'json',
                        cache: false,
                        method: 'POST',
                        data: data,
                        success: function (data, response) {
                            $.unblockUI();
                            if(data.status = "success"){
                                cTable.fnDeleteRow(nRow);
                                toastr.success('You have deleted Class : ' + data.result.class_name + ' and Subjects and Sections associated with it.');
                            } else if (data.status == "failed") {
                                toastr.warning(data.error.error_description);
                            }
                        }
                    });

                }
            });


        });
        $('#table-add-classes').on('click', '.save-row-classes', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                class_name: $(this).parents('tr').find('#new-input').val(),
                class_id: $(this).parents('tr').attr('data-class-id'),
                stream_id: $('#subview-add-classes').find("select").val()
            };
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl + '/admin/add/or/edit/class',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: data,
                success: function (data, response) {
                    console.log(data);
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(cTable, nRow, data.result);
                        toastr.info('You Have successfully added class :' + data.result.class_name);
                    } else if (data.status == "failed") {
                        //cTable.parentsUntil(".panel").find(".errorHandler").removeClass("no-display").html('<p class="help-block alert-danger">' + data.error_messages.class_name + '</p>');
                    }
                }
            });
        });
        $('#table-add-classes').on('click', '.edit-row-classes', function (e) {
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
        var cTable = $('#table-add-classes').dataTable({
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
        $('#table-add-classes_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-add-classes_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-add-classes_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-add-classes_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = cTable.fnSettings().aoColumns[iCol].bVisible;
            cTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable_AddClasses();
        }
    };
}();
