var TableDataPeriods = function() {
    "use strict";

    var periods = function() {
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
            jqTds[0].innerHTML = '<input type="text" id="period_name" class="form-control" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control" id="start_time" data-format="HH:mm" data-template="HH : mm" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control" id="end_time" data-format="HH:mm" data-template="HH : mm" value="' + aData[2] + '">';

            jqTds[3].innerHTML = '<a class="save-row-periods" href="">Save</a>';
            jqTds[4].innerHTML = '<a class="cancel-row-periods" href="">Cancel</a>';

            $('input[id="start_time"],input[id="end_time"]').each(function() {
                $(this).combodate({
                    firstItem: 'none', //show 'hour' and 'minute' string at first item of dropdown
                    minuteStep: 5
                });
            });

        }

        function timeFormat(time) {
            var timeString = time.split(':');
            var AmPm = timeString[1];
            var timeAmPm = AmPm.split(' ');

            if (timeAmPm[1] == "AM" || timeAmPm[1] == "PM") {
                timeAmPm[1] = "";
                timeString[1] = timeAmPm[0] + timeAmPm[1];
            }

            if (timeString[0] > '12') {
                timeString[0] = timeString[0] - 12;
                timeString[2] = 'PM';
            } else if (timeString[0] < '12') {
                timeString[2] = 'AM';
            } else {
                timeString[2] = 'PM';
            }
            time = timeString[0] + ':' + timeString[1] + ' ' + timeString[2];
            return time;
        }

        function saveRow(oTable, nRow, data) {
            var jqInputs = $('input', nRow);

            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(timeFormat(jqInputs[1].value), nRow, 1, false);
            oTable.fnUpdate(timeFormat(jqInputs[2].value), nRow, 2, false);
            oTable.fnUpdate('<a class="edit-row-periods" href="">Edit</a>', nRow, 3, false);
            oTable.fnUpdate('<a class="delete-row-periods" href="">Delete</a>', nRow, 4, false);
            oTable.fnDraw();
            nRow = nRow.setAttribute('data-period-id', data.result.period.id);
            newRow = false;
            actualEditingRow = null;
        }

        $('#table-periods-profile').on('click', '#period-profile-show-button', function(e) {
            e.preventDefault();
            oTable.fnClearTable();
            var period_profile_id = $(this).parents('tr').attr('data-period-profile-id');

            $('#table-school-periods').attr('data-table-period-profile', period_profile_id);

            var data = {
                period_profile_id: period_profile_id
            };

            $.ajax({
                url: serverUrl + '/admin/get/school/periods/by/id',
                dataType: 'json',
                data: data,
                method: 'POST',
                success: function(data) {
                    $.unblockUI();
                    $('#period-profile-name').text(data.result.profile.profile_name);

                    if (data.status === "success") {
                        var i;
                        var results = data.result.periods;
                        for (i = 0; i < results.length; i++) {

                            var aiNew = oTable.fnAddData(['', '', '', '', '']);
                            var nRow = oTable.fnGetNodes(aiNew[0]);
                            var nTr = oTable.fnSettings().aoData[aiNew[0]].nTr;
                            oTable.fnUpdate(results[i].period_name, nRow, 0, false);
                            $('td', nTr)[0].setAttribute('id', 'period_name');
                            oTable.fnUpdate(timeFormat(results[i].start_time), nRow, 1, false);
                            $('td', nTr)[1].setAttribute('id', 'start_time');
                            oTable.fnUpdate(timeFormat(results[i].end_time), nRow, 2, false);
                            $('td', nTr)[2].setAttribute('id', 'end_time');
                            oTable.fnUpdate('<a class="edit-row-periods" href="">Edit</a>', nRow, 3, false);
                            oTable.fnUpdate('<a class="delete-row-periods" href="">Delete</a>', nRow, 4, false);
                            nRow = nRow.setAttribute('data-period-id', results[i].id);
                            oTable.fnDraw();
                            newRow = false;
                            actualEditingRow = null;
                        }

                    }
                }
            });

        });

        $('body').on('click', '.add-row-periods', function(e) {
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
        $('#table-school-periods').on('click', '.cancel-row-periods', function(e) {

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
        $('#table-school-periods').on('click', '.delete-row-periods', function(e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];

            var data = {
                period_id: $(this).parents('tr').attr('data-period-id'),
                period_name: $(this).parents('tr').find('#period_name').text(),
                start_time: $(this).parents('tr').find('#start_time').text(),
                end_time: $(this).parents('tr').find('#end_time').text(),
                period_profile_id: $(this).parents('table').attr('data-table-period-profile')
            };

            console.log(data);

            bootbox.confirm("Are you sure to delete this row?", function(result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/delete/school/periods',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function(data) {

                            console.log(data);
                            $.unblockUI();
                            if (data.status === "success") {
                                oTable.fnDeleteRow(nRow);
                                toastr.success('This Period Has Been Deleted Successfully');
                            }
                        }
                    });

                }
            });
        });

        function validation(data) {

            if (data.period_name === "undefined" || data.period_name === "") {
                return false;
            } else if (data.start_time === "undefined" || data.start_time === "") {
                return false;
            } else if (data.end_time === "undefined" || data.end_time === "") {
                return false;
            }

            return true;

        }

        function errorPlacement(id, data) {

            var fieldName;
            $(id).parents('.panel-body').find('.errorHandler').find('p').remove('p');
            if (data.period_name === "undefined" || data.period_name === "") {
                fieldName = "Period Name";
            } else if (data.start_time === "undefined" || data.start_time === "") {
                fieldName = "Period Start Time";
            } else if (data.end_time === "undefined" || data.end_time === "") {
                fieldName = "Period End Time";
            }

            $(id).parents('.panel-body').find('.errorHandler').removeClass('no-display').append('<p>Please Input ' + fieldName + ' .</p>');

        }
        $('#table-school-periods').on('click', '.save-row-periods', function(e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];

            var data = {
                period_id: $(this).parents('tr').attr('data-period-id'),
                period_name: $(this).parents('tr').find('#period_name').val(),
                start_time: $(this).parents('tr').find('#start_time').val(),
                end_time: $(this).parents('tr').find('#end_time').val(),
                period_profile_id: $(this).parents('table').attr('data-table-period-profile')
            };

            if (validation(data)) {

                $(this).parents('.panel-body').find('.errorHandler').addClass('no-display');

                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                });

                $.ajax({
                    url: serverUrl + '/admin/set/school/periods',
                    dataType: 'json',
                    data: data,
                    method: 'POST',
                    success: function(data) {
                        $.unblockUI();
                        if (data.status === "success") {
                            saveRow(oTable, nRow, data);
                            toastr.success('New Period Has Been Added Successfully');
                        }
                    }
                });
            } else {
                errorPlacement(this, data);
            }
        });
        $('#table-school-periods').on('click', '.edit-row-periods', function(e) {
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
        var oTable = $('#table-school-periods').dataTable({
            paging: false,
            searching: false,
            ordering: false,
            info: false
        });
        $('#table-school-periods_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-school-periods_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-school-periods_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-school-periods_column_toggler input[type="checkbox"]').change(function() {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });

        $('input#make-current-period-profile').on('ifChecked', function(e) {
            e.preventDefault();
            var profile_id = $(this).parents('tr').attr('data-period-profile-id');

            if (profile_id) {
                
                bootbox.confirm("Are you sure , You want to change Current Profile?", function(result) {

                    var data = {
                        profile_id: profile_id
                    };

                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });

                    $.ajax({
                        url: serverUrl + '/admin/make/current/period/profile',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function(data) {
                            $.unblockUI();
                            if (data.status === "success") {
                                toastr.success('Congratulations. This is Your Current Profile.');
                            }
                        }
                    });

                });

            }

        });
    };

    var periodsProfile = function() {

        $('#add-new-periods-profile-button').on('click', function(e) {
            e.preventDefault();
            $('#add-new-periods-profile-row').removeClass('no-display');

            $('#add-new-periods-profile-save-button').on('click', function(e) {
                e.preventDefault();

                var profile_name = $('#profile-name').val();

                if (profile_name) {

                    var data = {
                        profile_name: profile_name
                    };

                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: serverUrl + '/admin/set/school/periods/profile',
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        success: function(data) {
                            $.unblockUI();
                            $('#profile-name').val('');
                            if (data.status === "success") {
                                var rowCount = $('#table-periods-profile >tbody >tr').length;
                                rowCount = rowCount + 1;
                                var apend = '<tr data-period-profile-id=""><td>' + rowCount + '</td>\n\
                                             <td><a class="show-sv" href="#subview-add-period-profile" data-startFrom="right">' + data.result.profile.profile_name + '</a></td>\n\
                                             <td class="center"><div class="radio-inline"><input type="radio" class="square-red" name="make-current-period-profile"></div></td></tr>';
                                $('#table-periods-profile').find('tbody').append(apend);
                                $.hideSubview();
                                toastr.success('This Period Profile Has Been Created Successfully');
                            } else if (data.status === "failed") {
                                $.hideSubview();
                                toastr.info('This Period Profile Couldnt Created Successfully. Try Again Later');
                            }
                        }
                    });
                } else {
                    $('#profile-name').parent().append('<span class="help-block">Please specify Profile name</span>').parents('.form-group').addClass('has-error');
                }

            });

        });

    };
    return {
        //main function to initiate template pages
        init: function() {
            periods();
            periodsProfile();
        }
    };
}();
