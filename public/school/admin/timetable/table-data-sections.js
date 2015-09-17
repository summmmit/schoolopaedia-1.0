var TableDataSections = function () {
    "use strict";
    var runDataTable_AddSections = function () {
        var newRow = false;
        var actualEditingRow = null;

        $('#button-show-sections').on('click', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            $('#subview-add-classes').find('#form-field-select-sections-streams');

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

            $('#subview-add-sections').find('#form-field-select-sections-streams')
                .append('<option value="' + result.id + '">' + result.stream_name + '</option>');
        }

        $('#form-field-select-sections-streams').on('change', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            var stream_id = $(this).val();

            if (stream_id) {
                $('#select-sections-classes-dropdown').removeClass('no-display');

                var data = {
                    'stream_id': stream_id
                }

                $.ajax({
                    url: serverUrl + '/admin/get/all/classes/by/stream/id',
                    dataType: 'json',
                    method: 'POST',
                    data: data,
                    success: function (data, response) {
                        if (data.result.length > 0) {
                            $('#form-field-select-sections-classes').empty();
                            $('#form-field-select-sections-classes').append('<option value="">Select a Class....</option>');
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllClassesToDropDown(data.result[i]);
                            }
                        } else {
                            $('#form-field-select-sections-classes').empty();
                            $('#form-field-select-sections-classes').append('<option value="">No Class in this Stream.</option>');
                        }
                    }
                });
            } else {
                $('#select-sections-classes-dropdown').addClass('no-display');
            }
            $('#button-add-section').addClass('no-display');
            $('#sections-table').addClass('no-display');
        });

        function attachAllClassesToDropDown(result) {

            $('#subview-add-sections').find('#form-field-select-sections-classes')
                .append('<option value="' + result.id + '">' + result.class_name + '</option>');
        }

        $('#form-field-select-sections-classes').on('change', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            var class_id = $(this).val();

            if (class_id) {
                $('#button-add-section').removeClass('no-display');
                $('#sections-table').removeClass('no-display');

                var data = {
                    'class_id': class_id
                }

                $.ajax({
                    url: serverUrl + '/admin/get/all/sections/by/class/id',
                    dataType: 'json',
                    method: 'POST',
                    data: data,
                    success: function (data, response) {
                        if (data.result.length > 0) {
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllSections(oTable, data.result[i]);
                            }
                        }
                    }
                });
            } else {
                $('#button-add-section').addClass('no-display');
                $('#sections-table').addClass('no-display');
            }
        });

        function attachAllSections(oTable, result) {

            var aiNew = oTable.fnAddData(['', '', '']);
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
            jqTds[0].innerHTML = '<input type="text" class="form-control" id="new-input" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="save-row-sections" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel-row-sections" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(result.section_name, nRow, 0, false);
            oTable.fnUpdate('<a class="edit-row-sections" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete-row-sections" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
            nRow = nRow.setAttribute('data-section-id', result.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-sections', function (e) {
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
        $('#table-add-sections').on('click', '.cancel-row-sections', function (e) {
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
        $('#table-add-sections').on('click', '.delete-row-sections', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;
            }
            var nRow = $(this).parents('tr')[0];

            var data = {
                section_id: $(this).parents('tr').attr('data-section-id')
            };

            bootbox.confirm("Are you sure to delete this row?", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/delete/section',
                        dataType: 'json',
                        method: 'POST',
                        cache: false,
                        data: data,
                        success: function (data, response) {
                            $.unblockUI();
                            if (data.status == "success") {
                                toastr.success('You have deleted Section : ' + data.result.section_name);
                                oTable.fnDeleteRow(nRow);
                            } else if (data.status == "failed") {
                                toastr.info(data.error.error_description);
                            }
                        }
                    });

                }
            });


        });
        $('#table-add-sections').on('click', '.save-row-sections', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                section_id: $(this).parents('tr').find('#new-input').parent().attr('id'),
                section_name: $(this).parents('tr').find('#new-input').val(),
                class_id: $('#form-field-select-sections-classes').val()
            };

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl + '/admin/add/or/edit/section',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: data,
                success: function (data, response) {
                    $.unblockUI();
                    console.log(data);
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.result);
                        toastr.info('You have successfully Created new Section');
                    } else if (data.status == "failed") {
                        toastr.info(data.error.error_description);
                    }
                }
            });
        });
        $('#table-add-sections').on('click', '.edit-row-sections', function (e) {
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
        var oTable = $('#table-add-sections').dataTable({
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
        $('#table-add-sections_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-add-sections_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-add-sections_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-add-sections_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    };
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable_AddSections();
        }
    };
}();
