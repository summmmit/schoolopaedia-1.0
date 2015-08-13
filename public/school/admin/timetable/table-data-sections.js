var TableDataSections = function() {
    "use strict";
    var runDataTable_AddSections = function() {
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
            jqTds[1].innerHTML = '<a class="save-row-sections" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel-row-sections" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, classId, sectionId) {
            var jqInputs = $('input', nRow);
            var isExistsId = nRow.setAttribute('id', classId);
            var nTr = oTable.fnSettings().aoData;
            nTr = nTr[nTr.length - 1];
            nTr = nTr.nTr;
            $('td', nTr)[0].setAttribute('id', sectionId);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit-row-sections" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete-row-sections" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-sections', function(e) {
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
        $('#table-add-sections').on('click', '.cancel-row-sections', function(e) {
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
        $('#table-add-sections').on('click', '.delete-row-sections', function(e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            var id = $(this).parents('tr').attr('id');
            var section_name = $(this).parent().prev().prev().text();
            var section_id = $(this).parent().prev().prev().attr('id');

            var data = {
                class_id: id,
                section_id: section_id,
                section_name: section_name
            };

            bootbox.confirm("Are you sure to delete this row?", function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/time/table/delete/sections',
                        dataType: 'json',
                        method: 'POST',
                        cache: false,
                        data: data,
                        success: function(data, response) {
                            $.unblockUI();
                            toastr.success('You have deleted Section : ' + section_name);
                            oTable.fnDeleteRow(nRow);
                        }
                    });

                }
            });



        });
        $('#table-add-sections').on('click', '.save-row-sections', function(e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var input = $(this).parents('tr').find('#new-input').val();
            var class_id = $('#form-field-select-classes').val();
            var section_id = $(this).parents('tr').find('#new-input').parent().attr('id');
            var data = {
                section_id: section_id,
                section_name: input,
                class_id: class_id
            };
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl + '/admin/time/table/add/sections',
                dataType: 'json',
                cache: false,
                method: 'POST',
                data: data,
                success: function(data, response) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(oTable, nRow, class_id, data.data_send.id);
                        toastr.info('You have successfully Created new Section');
                    } else if (data.status == "failed") {
                        oTable.parentsUntil(".panel").find(".errorHandler").removeClass("no-display").html('<p class="help-block alert-danger">' + data.error_messages.section_name + '</p>');
                    }
                }
            });
        });
        $('#table-add-sections').on('click', '.edit-row-sections', function(e) {
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
        $('#table-add-sections_column_toggler input[type="checkbox"]').change(function() {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
        $('#form-field-select-classes').on('change', function() {
            var optionValue = $(this).val();

            if (optionValue !== "" && optionValue !== "undefined" && optionValue !== null) {
                $('#subview-add-sections').find('#add-section-button').removeClass("no-display");
            } else {
                $('#subview-add-sections').find('#add-section-button').addClass("no-display");
            }
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            var data = {
                class_id: optionValue
            };

            $.ajax({
                url: serverUrl + '/admin/time/table/get/sections',
                dataType: 'json',
                method: 'POST',
                data: data,
                success: function(data, response) {
                    oTable.fnClearTable();
                    $.unblockUI();
                    var i;
                    var sections = data.result.sections;
                    for (i = 0; i < sections.length; i++) {
                        deleteAndCreateTable(oTable, optionValue, sections[i].id, sections[i].section_name);
                    }
                }
            });

        });
        function deleteAndCreateTable(oTable, trId, firstTdId, firstTdData) {

            var aiNew = oTable.fnAddData(['', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            nRow = nRow.setAttribute('id', trId);
            var nTr = oTable.fnSettings().aoData[aiNew[0]].nTr;
            $('td', nTr)[0].setAttribute('id', firstTdId);
            oTable.fnUpdate(firstTdData, nRow, 0, false);
            oTable.fnUpdate('<a class="edit-row-sections" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete-row-sections" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();

            nRow = false;
        }
    };

    var fetchClasses = function() {

        $.ajax({
            url: serverUrl + '/admin/time/table/get/class/streams/pair',
            dataType: 'json',
            method: 'POST',
            success: function(data, response) {
                var i;
                var pairs = data.result.stream_class_pairs;
                for (i = 0; i < data.result.stream_class_pairs.length; i++) {
                    $('#form-field-select-classes').append('<option value=' + pairs[i].classes_id + '>' + pairs[i].stream_class_pair + '</option>');
                }
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function() {
            runDataTable_AddSections();
            fetchClasses();
        }
    };
}();
