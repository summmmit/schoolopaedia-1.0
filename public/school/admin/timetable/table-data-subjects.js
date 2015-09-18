var TableDataSchoolSubjects = function() {
    "use strict";
    var runDataTable_AddSubjects = function() {
        var newRow = false;
        var actualEditingRow = null;

        $('#button-show-subjects').on('click', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

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

            $('#subview-add-subjects').find('#form-field-select-subjects-streams')
                .append('<option value="' + result.id + '">' + result.stream_name + '</option>');
        }

        $('#form-field-select-subjects-streams').on('change', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            var stream_id = $(this).val();

            if (stream_id) {
                $('#select-subjects-classes-dropdown').removeClass('no-display');

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
                            $('#form-field-select-subjects-classes').empty();
                            $('#form-field-select-subjects-classes').append('<option value="">Select a Class....</option>');
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllClassesToDropDown(data.result[i]);
                            }
                        } else {
                            $('#form-field-select-subjects-classes').empty();
                            $('#form-field-select-subjects-classes').append('<option value="">No Class in this Stream.</option>');
                        }
                    }
                });
            } else {
                $('#select-subjects-classes-dropdown').addClass('no-display');
                $('#select-subjects-sections-dropdown').addClass('no-display');
            }
            $('#button-add-subjects').addClass('no-display');
            $('#subjects-table').addClass('no-display');
        });

        function attachAllClassesToDropDown(result) {

            $('#subview-add-subjects').find('#form-field-select-subjects-classes')
                .append('<option value="' + result.id + '">' + result.class_name + '</option>');
        }

        $('#form-field-select-subjects-classes').on('change', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            var class_id = $(this).val();

            if (class_id) {
                $('#select-subjects-sections-dropdown').removeClass('no-display');
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
                            $('#form-field-select-subjects-sections').empty();
                            $('#form-field-select-subjects-sections').append('<option value="">Select a Sections....</option>');
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllSections(oTable, data.result[i]);
                            }
                        } else {
                            $('#form-field-select-subjects-sections').empty();
                            $('#form-field-select-subjects-sections').append('<option value="">No Sections in this Class.</option>');
                        }
                    }
                });
            } else {
                $('#select-subjects-sections-dropdown').addClass('no-display');
                $('#button-add-subjects').addClass('no-display');
                $('#subjects-table').addClass('no-display');
            }
        });

        function attachAllSections(oTable, result){

            $('#subview-add-subjects').find('#form-field-select-subjects-sections')
                .append('<option value="' + result.id + '">' + result.section_name + '</option>');
        }

        $('#form-field-select-subjects-sections').on('change', function (e) {
            e.preventDefault();
            oTable.fnClearTable();

            var section_id = $(this).val();

            if (section_id) {
                $('#button-add-subjects').removeClass('no-display');
                $('#subjects-table').removeClass('no-display');

                var data = {
                    'section_id': section_id
                }

                $.ajax({
                    url: serverUrl + '/admin/get/all/subjects/by/section/id',
                    dataType: 'json',
                    method: 'POST',
                    data: data,
                    success: function (data, response) {
                        if (data.result.length > 0) {
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllSubjects(oTable, data.result[i]);
                            }
                        }
                    }
                });
            } else {
                $('#button-add-subjects').addClass('no-display');
                $('#subjects-table').addClass('no-display');
            }
        });

        function attachAllSubjects(oTable, result) {

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
            jqTds[0].innerHTML = '<input type="text" class="form-control" id="new-input-subject-name" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control" id="new-input-subject-code" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<a class="save-row-subjects" href="">Save</a>';
            jqTds[3].innerHTML = '<a class="cancel-row-subjects" href="">Cancel</a>';

        }

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate(result.subject_name, nRow, 0, false);
            oTable.fnUpdate(result.subject_code, nRow, 1, false);
            oTable.fnUpdate('<a class="edit-row-subjects" href="">Edit</a>', nRow, 2, false);
            oTable.fnUpdate('<a class="delete-row-subjects" href="">Delete</a>', nRow, 3, false);
            oTable.fnDraw();
            nRow.setAttribute('data-subject-id', result.id);         //subject id added to the attribute of the row
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

            var data = {
                subject_id: $(this).parents('tr').attr('data-subject-id')
            };

            bootbox.confirm("Are you sure to delete this row?", function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/delete/subject',
                        dataType: 'json',
                        method: 'POST',
                        cache: false,
                        data: data,
                        success: function(data, response) {
                            $.unblockUI();
                            if (data.status == "success") {
                                oTable.fnDeleteRow(nRow);
                                toastr.success('You have successfully deleted Subject');
                            } else if (data.status == "failed") {
                                toastr.warning(data.error.error_description);
                            }
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
            var section_id = $('#form-field-select-subjects-sections').val();
            var data = {
                section_id: section_id,
                subject_id: subject_id,
                subject_name: subject_name,
                subject_code: subject_code
            };
            
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });
            $.ajax({
                url: serverUrl + '/admin/add/or/edit/subject',
                dataType: 'json',
                method: 'POST',
                data: data,
                cache: false,
                success: function(data, response) {
                    $.unblockUI();
                    if (data.status == "success") {
                        saveRow(oTable, nRow, data.result);
                        toastr.info('You have successfully Created new Subject');
                    } else if (data.status == "failed") {
                        toastr.warning(data.error.error_description);
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
    };
    return {
        //main function to initiate template pages
        init: function() {
            runDataTable_AddSubjects();
        }
    };
}();
