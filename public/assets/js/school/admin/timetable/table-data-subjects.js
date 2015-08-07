var TableDataSubjects = function() {
    "use strict";
    var runDataTable_AddSubjects = function() {
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
            jqTds[0].innerHTML = '<input type="text" class="form-control" id="new-input-subject-name" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control" id="new-input-subject-code" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<a class="save-row-subjects" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row-subjects" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, subjects) {
            var jqInputs = $('input', nRow);
            nRow.setAttribute('id', subjects.class_id);                // class id added to the attribute of the row
            nRow.setAttribute('data-section-id', subjects.section_id); //section id added to the attribute of the row
            nRow.setAttribute('data-subject-id', subjects.id);         //subject id added to the attribute of the row
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate('<a class="edit-row-subjects" href="">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="delete-row-subjects" href="">Delete</a>', nRow, 3, false);
            oTable.fnDraw();
            newRow = false;
            actualEditingRow = null;
        }

        $('body').on('click', '.add-row-subjects', function(e) {
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
        $('#table-add-subjects').on('click', '.cancel-row-subjects', function(e) {
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
        $('#table-add-subjects').on('click', '.delete-row-subjects', function(e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            var class_id = $(this).parents('tr').attr('id');
            var subject_id = $(this).parents('tr').attr('data-subject-id');
            var section_id = $(this).parents('tr').attr('data-section-id');
            var subject_name = $(this).parent().prev().prev().prev().text();
            var subject_code = $(this).parent().prev().prev().text();

            var data = {
                class_id: class_id,
                section_id: section_id,
                subject_id: subject_id,
                subject_name: subject_name,
                subject_code: subject_code
            };
            bootbox.confirm("Are you sure to delete this row?", function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/time/table/delete/subjects',
                        dataType: 'json',
                        method: 'POST',
                        cache: false,
                        data: data,
                        success: function(data, response) {
                            $.unblockUI();
                            oTable.fnDeleteRow(nRow);
                            toastr.success('You have deleted Subject: ' + subject_name);
                        }
                    });

                }
            });



        });
        $('#table-add-subjects').on('click', '.save-row-subjects', function(e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var subject_id = $(this).parents('tr').attr('data-subject-id');
            var subject_name = $(this).parents('tr').find('#new-input-subject-name').val();
            var subject_code = $(this).parents('tr').find('#new-input-subject-code').val();
            var class_id = $('#form-field-select-subjects-classes').val();
            var section_id = $('#form-field-select-subjects-sections').val();
            var data = {
                class_id: class_id,
                section_id: section_id,
                subject_id: subject_id,
                subject_name: subject_name,
                subject_code: subject_code
            };
            
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl + '/admin/time/table/add/subjects',
                dataType: 'json',
                method: 'POST',
                data: data,
                cache: false,
                success: function(data, response) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.result.subjects);
                        toastr.info('You have successfully Created new Subject: ' + subject_name);
                    } else if (data.status == "failed") {
                        oTable.parentsUntil(".panel").find(".errorHandler").removeClass("no-display").html('<p class="help-block alert-danger">' + data.error_messages.subject_name + '</p>');
                    }
                }
            });
        });
        $('#table-add-subjects').on('click', '.edit-row-subjects', function(e) {
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
        var oTable = $('#table-add-subjects').dataTable({
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
        $('#table-add-subjects_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-add-subjects_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-add-subjects_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-add-subjects_column_toggler input[type="checkbox"]').change(function() {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });

        $('#form-field-select-subjects-classes').on('change', function() {
            var class_id = $(this).val();

            oTable.fnClearTable();
            $('#form-field-select-subjects-sections').empty().append('<option value="">Select a Section...</option>');

            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            var data = {
                class_id: class_id
            };

            $.ajax({
                url: serverUrl + '/admin/time/table/get/sections',
                dataType: 'json',
                method: 'POST',
                data: data,
                success: function(data, response) {
                    $.unblockUI();
                    var i;
                    var section = data.result.sections;
                    for (i = 0; i < section.length; i++) {
                        $('#form-field-select-subjects-sections').append('<option value=' + section[i].id + '>' + section[i].section_name + '</option>');
                    }
                }
            });

        });
        $('#form-field-select-subjects-sections').on('change', function() {
            var section_id = $(this).val();
            oTable.fnClearTable();
            if (section_id) {
                $('#subview-add-subjects').find('#add-subjects-button').removeClass("no-display");
            } else {
                $('#subview-add-subjects').find('#add-subjects-button').addClass("no-display");
            }
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            var data = {
                section_id: section_id,
                class_id: $('#form-field-select-subjects-classes').val()
            };

            $.ajax({
                url: serverUrl + '/admin/time/table/get/subjects',
                dataType: 'json',
                method: 'POST',
                data: data,
                success: function(data, response) {
                    $.unblockUI();
                    var i;
                    var subjects = data.result.subjects;
                    for (i = 0; i < subjects.length; i++) {
                        deleteAndCreateTable(oTable, subjects[i]);
                    }
                }
            });

        });
        function deleteAndCreateTable(oTable, subjects) {

            var aiNew = oTable.fnAddData(['', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            nRow.setAttribute('id', subjects.class_id);                // class id added to the attribute of the row
            nRow.setAttribute('data-section-id', subjects.section_id); //section id added to the attribute of the row
            nRow.setAttribute('data-subject-id', subjects.id);         //subject id added to the attribute of the row
            oTable.fnUpdate(subjects.subject_name, nRow, 0, false);
            oTable.fnUpdate(subjects.subject_code, nRow, 1, false);
            oTable.fnUpdate('<a class="edit-row-subjects" href="">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="delete-row-subjects" href="">Delete</a>', nRow, 3, false);
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
                    $('#form-field-select-subjects-classes').append('<option value=' + pairs[i].classes_id + '>' + pairs[i].stream_class_pair + '</option>');
                }
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function() {
            runDataTable_AddSubjects();
            fetchClasses();
        }
    };
}();
