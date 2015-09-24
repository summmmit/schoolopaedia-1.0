var TableDataSchoolTeachers = function() {
	"use strict";
	var runDataTable_SchoolTeachers = function() {
		var newRow = false;
		var actualEditingRow = null;

		$.ajax({
			url: serverUrl + '/admin/get/all/teachers',
			dataType: 'json',
			method: 'POST',
			success: function (data, response) {
				console.log(data);
				for (var i = 0; i < data.result.length; i++) {
					attachAllTeachers(data.result[i]);
				}
			}
		});

		function attachAllTeachers(result) {

			var aiNew = oTable.fnAddData(['', '', '', '']);
			var nRow = oTable.fnGetNodes(aiNew[0]);

			oTable.fnUpdate(result.first_name + ' ' + result.last_name, nRow, 0, false);
            if(result.pic){
                oTable.fnUpdate('<img src="'+ result.pic +'">', nRow, 1, false);
            }else{
                oTable.fnUpdate('<img class="img-thumbnail no-margin" src="'+ serverUrl + '/school/images/anonymous.jpg' +'" alt="no-image" width="40px" height="40px">', nRow, 1, false);
            }
			oTable.fnUpdate('<a class="details-show-edit-row" href="#">Details</a>', nRow, 2, false);
            oTable.fnUpdate('<input type="checkbox"  class="make-switch" data-on-color="success" data-off-color="danger" data-on-text="Enabled" data-off-text="Left">', nRow, 3, false);
			oTable.fnDraw();
			nRow.setAttribute('data-teacher-id', result.user_id);         //user id of teacher added to the attribute of the row
			newRow = false;
			actualEditingRow = null;

            $("input[type='checkbox'].make-switch").bootstrapSwitch();
		}

        $('#table-school-teachers').on('click', '.details-show-edit-row', function(e) {
            e.preventDefault();

            $.subview({
                content: "#subview-school-teachers-details",
                startFrom: "right"
            });
        });

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
			oTable.fnUpdate('<a class="edit-row" href="">Details</a>', nRow, 2, false);
            var button = '<input type="checkbox" class="make-switch" data-on-color="primary" checked>';
			//oTable.fnUpdate('<a class="delete-row" href="">Working</a>', nRow, 3, false);
			oTable.fnUpdate(button, nRow, 3, false);
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
		$('#table-school-teachers').on('click', '.cancel-row', function(e) {

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
		$('#table-school-teachers').on('click', '.delete-row', function(e) {
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
		$('#table-school-teachers').on('click', '.save-row', function(e) {
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
		$('#table-school-teachers').on('click', '.edit-row', function(e) {
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
		var oTable = $('#table-school-teachers').dataTable({
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
		$('#table-school-teachers_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
		// modify table search input
		$('#table-school-teachers_wrapper .dataTables_length select').addClass("m-wrap small");
		// modify table per page dropdown
		$('#table-school-teachers_wrapper .dataTables_length select').select2();
		// initialzie select2 dropdown
		$('#table-school-teachers_column_toggler input[type="checkbox"]').change(function() {
			/* Get the DataTables object again - this is not a recreation, just a get of the object */
			var iCol = parseInt($(this).attr("data-column"));
			var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
			oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			runDataTable_SchoolTeachers();
		}
	};
}();
