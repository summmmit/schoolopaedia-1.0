var TableDataTimeTableNew = function() {

	"use strict";
	var runDataTable_TimeTable = function() {
		var newRow = false;
		var actualEditingRow = null;

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

        function attachAllStreamsToDropDown(result) {
            $('#form-field-select-streams').append('<option value="' + result.id + '">' + result.stream_name + '</option>');
        }

        $('body').on('change', '#form-field-select-streams', function(e) {
            e.preventDefault();
            
            clearClasses();
            hideTimeTable();
            oTable.fnClearTable();
            hideSections();
            clearSections();
            clearDays();
            hideDays();

            var stream_id = $(this).val();

            if(stream_id){

                showClasses();

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
                            attachAllClasses(data.result[i]);
                        }
                    }
                });
            }else{
                hideClasses();
            }
        });

        function attachAllClasses(result) {
            $('#form-field-select-classes')
                .append('<option value="' + result.id + '">' + result.class_name + '</option>');
        }

        function showClasses(){
            $('body').find('#select-classes-dropdown').removeClass('no-display');
        }

        function hideClasses(){
            $('body').find('#select-classes-dropdown').addClass('no-display');
        }

        function clearClasses(){
            $('body').find('#form-field-select-classes').empty();
            $('body').find('#form-field-select-classes').append('<option value="">Select a Class...</option>');
        }

        function attachAllSections(result) {
            $('#form-field-select-sections')
                .append('<option value="' + result.id + '">' + result.section_name + '</option>');
        }

        $('body').on('change', '#form-field-select-classes', function(e) {
            e.preventDefault();
            clearSections();
            hideTimeTable();
            oTable.fnClearTable();
            clearDays();
            hideDays();

            var class_id = $(this).val();

            if (class_id) {

                showSections();

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
                                attachAllSections(data.result[i]);
                            }
                        } else {
                        }
                    }
                });
            } else {
                hideSections();
            }
        });

        function showSections(){
            $('body').find('#select-sections-dropdown').removeClass('no-display');
        }

        function hideSections(){
            $('body').find('#select-sections-dropdown').addClass('no-display');
        }

        function clearSections(){
            $('body').find('#form-field-select-sections').empty();
            $('body').find('#form-field-select-sections').append('<option value="">Select a Section...</option>');
        }

        function attachAllWeekDays(result) {
            $('#form-field-select-days')
                .append('<option value="' + result.id + '">' + result.day + '</option>');
        }

        $('body').on('change', '#form-field-select-sections', function(e) {
            e.preventDefault();
            clearDays();
            hideTimeTable();
            oTable.fnClearTable();

            if ($(this).val()) {
                showDays();

                $.ajax({
                    url: serverUrl + '/admin/get/all/weekdays',
                    dataType: 'json',
                    method: 'POST',
                    success: function (data, response) {
                        if (data.result.length > 0) {
                            for (var i = 0; i < data.result.length; i++) {
                                attachAllWeekDays(data.result[i]);
                            }
                        } else {
                        }
                    }
                });
            } else {
                hideDays();
            }
        });

        function showDays(){
            $('body').find('#select-days-dropdown').removeClass('no-display');
        }

        function hideDays(){
            $('body').find('#select-days-dropdown').addClass('no-display');
        }

        function clearDays(){
            $('body').find('#form-field-select-days').empty();
            $('body').find('#form-field-select-days').append('<option value="">Select a day...</option>');
        }

        $('body').on('change', '#form-field-select-days', function(e) {
            e.preventDefault();
            oTable.fnClearTable();

            var day_id = $(this).val();

            if (day_id) {

                showTimeTable();
            } else {
                hideTimeTable();
            }
        });

        function showTimeTable(){
            $('body').find('#section-time-table').removeClass('no-display');
        }

        function hideTimeTable(){
            $('body').find('#section-time-table').addClass('no-display');
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
			jqTds[0].innerHTML = '<input type="text" class="form-control" value="' + aData[0] + '">';
			jqTds[1].innerHTML = '<input type="text" class="form-control" value="' + aData[1] + '">';
			jqTds[2].innerHTML = '<input type="text" class="form-control" value="' + aData[2] + '">';

			jqTds[3].innerHTML = '<a class="save-row" href="">Save</a>';
			jqTds[4].innerHTML = '<a class="cancel-row" href="">Cancel</a>';

		}

		function saveRow(oTable, nRow) {
			var jqInputs = $('input', nRow);
			oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
			oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
			oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
			oTable.fnUpdate('<a class="edit-row" href="">Edit</a>', nRow, 3, false);
			oTable.fnUpdate('<a class="delete-row" href="">Delete</a>', nRow, 4, false);
			oTable.fnDraw();
			newRow = false;
			actualEditingRow = null;
		}

		$('body').on('click', '.add-row', function(e) {
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
		$('#table-time-table').on('click', '.cancel-row', function(e) {

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
		$('#table-time-table').on('click', '.delete-row', function(e) {
			e.preventDefault();
			if (newRow && actualEditingRow) {
				oTable.fnDeleteRow(actualEditingRow);
				newRow = false;

			}
			var nRow = $(this).parents('tr')[0];
			bootbox.confirm("Are you sure to delete this row?", function(result) {
				if (result) {
					$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
					});
					$.mockjax({
						url : '/tabledata/delete/webservice',
						dataType : 'json',
						responseTime : 1000,
						responseText : {
							say : 'ok'
						}
					});
					$.ajax({
						url : '/tabledata/delete/webservice',
						dataType : 'json',
						success : function(json) {
							$.unblockUI();
							if (json.say == "ok") {
							oTable.fnDeleteRow(nRow);
							}
						}
					});				
					
				}
			});
			

			
		});
		$('#table-time-table').on('click', '.save-row', function(e) {
			e.preventDefault();

			var nRow = $(this).parents('tr')[0];
			$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
					});
					$.mockjax({
						url : '/tabledata/add/webservice',
						dataType : 'json',
						responseTime : 1000,
						responseText : {
							say : 'ok'
						}
					});
					$.ajax({
						url : '/tabledata/add/webservice',
						dataType : 'json',
						success : function(json) {
							$.unblockUI();
							if (json.say == "ok") {
								saveRow(oTable, nRow);
							}
						}
					});	
		});
		$('#table-time-table').on('click', '.edit-row', function(e) {
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
		var oTable = $('#table-time-table').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[0, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
		});
		$('#table-time-table_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
		// modify table search input
		$('#table-time-table_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
		$('#table-time-table_wrapper .dataTables_length select').select2();
		// initialzie select2 dropdown
		$('#table-time-table_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			runDataTable_TimeTable();
		}
	};
}();
