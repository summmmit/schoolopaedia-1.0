var TableDataInbox = function () {
    "use strict";
    var InboxMailsTable = function () {

        var newRow = false;
        var actualEditingRow = null;

        function attachInboxMails(oTable) {

            $.ajax({
                url: serverUrl + '/admin/get/all/inbox/mails',
                dataType: 'json',
                method: 'POST',
                success: function (data, response) {
                    console.log(data);
                    if (data.status == "success") {
                        for (var i = 0; i < data.result.mails.length; i++) {

                            var aiNew = oTable.fnAddData(['', '', '', '', '']);
                            var nRow = oTable.fnGetNodes(aiNew[0]);

                            saveRow(oTable, nRow, data.result.mails[i]);
                        }
                        attachInboxFolders(data.result);
                    }
                },
                error: function (data) {
                }
            });
        }

        function attachInboxFolders(folder) {

            // give each folder an id

            // inbox folder
            for (var i = 0; i < folder.inbox_folders.length; i++) {

                if (folder.inbox_folders[i].folder_id == FOLDER_INBOX_ID) {
                    $('.inbox-incoming-mails').attr('data-folder-id', folder.inbox_folders[i].id);
                } else if (folder.inbox_folders[i].folder_id == FOLDER_SENT_MAILS_ID) {
                    $('.inbox-sent-mails').attr('data-folder-id', folder.inbox_folders[i].id);
                }
            }

            for (var i = 0; i < folder.inbox_folders.length; i++) {

                if ((folder.inbox_folders[i].folder_id == FOLDER_INBOX_ID)) {
                }else if(folder.inbox_folders[i].folder_id == FOLDER_SENT_MAILS_ID){
                }else if(folder.inbox_folders[i].folder_id == FOLDER_TRASH_ID){
                }else{
                    $('#move_to_inbox_folders').append('<li><a href="#" id="move_mail" data-move-to-folder-id="'+ folder.inbox_folders[i].folder_id +'"><i class="fa fa-external-link"></i> '+ folder.inbox_folders[i].folder_name +'</a></li>');
                }
            }
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

        function saveRow(oTable, nRow, result) {

            oTable.fnUpdate('<label class="checkbox-inline" style="margin-top: 0px !important;"><input name="' + result.mail.id + '" type="checkbox" class="mail-checkbox grey"></label>', nRow, 0, false);
            oTable.fnUpdate('<i class="fa fa-star"></i>', nRow, 1, false);
            oTable.fnUpdate(result.mail.subject, nRow, 2, false);
            oTable.fnUpdate(result.mail.message, nRow, 3, false);
            oTable.fnUpdate(moment(result.mail.created_at).format('ll'), nRow, 4, false);
            oTable.fnDraw();
            if (!result.mails_to_user.is_read) {
                nRow.setAttribute('class', 'unread');
            }
            nRow.setAttribute('data-mails-to-user-id', result.mails_to_user.id);
            nRow.setAttribute('data-mail-id', result.mail.id);
            newRow = false;
            actualEditingRow = null;

            $('input[type="checkbox"].grey, input[type="radio"].grey').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red',
            });
        }

        $('body').on('click', '.add-row', function (e) {
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

        $('#table-inbox-incoming-mails').on('click', '.cancel-row', function (e) {

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

        $('#table-inbox-incoming-mails').on('click', '.delete-row', function (e) {
            e.preventDefault();
            if (newRow && actualEditingRow) {
                oTable.fnDeleteRow(actualEditingRow);
                newRow = false;

            }
            var nRow = $(this).parents('tr')[0];
            bootbox.confirm("Are you sure to delete this row?", function (result) {
                if (result) {
                    $.blockUI({
                        message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                    });
                    $.ajax({
                        url: '/tabledata/delete/webservice',
                        dataType: 'json',
                        success: function (json) {
                            $.unblockUI();
                            if (json.say == "ok") {
                                oTable.fnDeleteRow(nRow);
                            }
                        }
                    });

                }
            });


        });

        $('#table-inbox-incoming-mails').on('click', '.save-row', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            $.blockUI({
                message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
            });

            $.ajax({
                url: serverUrl + '/admin/get/all/inbox/mails',
                dataType: 'json',
                method: 'POST',
                success: function (data, response) {
                    console.log(data);
                    if (data.status == "success") {

                        for (var i = 0; i < data.result.length; i++) {
                            saveRow(oTable, nRow, data.result[i]);
                        }
                    }
                },
                error: function (data) {
                }
            });
        });

        $('#table-inbox-incoming-mails').on('click', '.edit-row', function (e) {
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

        var oTable = $('#table-inbox-incoming-mails').dataTable({
            "aoColumnDefs": [
                {"sClass": "inbox-small-cells", "aTargets": [0]},
                {"sClass": "inbox-small-cells", "aTargets": [1]},
                {"sClass": "view-message dont-show show-read-mail", "aTargets": [2]},
                {"sClass": "view-message show-read-mail", "aTargets": [3]},
                {"sClass": "view-message text-right show-read-mail", "aTargets": [4]},
            ],
            "oLanguage": {
                "sLengthMenu": "Show _MENU_ Rows",
                "sSearch": "",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            },
            "sDom": 'lfrtip',
            "aaSorting": [[4, 'desc']],
            "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });

        $('#table-inbox-incoming-mails_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        // modify table search input
        $('#table-inbox-incoming-mails_wrapper .dataTables_length select').addClass("m-wrap small");
        // modify table per page dropdown
        $('#table-inbox-incoming-mails_wrapper .dataTables_length select').select2();
        // initialzie select2 dropdown
        $('#table-inbox-incoming-mails_column_toggler input[type="checkbox"]').change(function () {
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, ( bVis ? false : true));
        });

        // on click on any mail ...hide compose email and inbox .
        $('#table-inbox-incoming-mails,#table-inbox-sent-mails').on('click', '.show-read-mail', function (e) {
            e.preventDefault();

            oTable.fnClearTable();

            hideInboxFolder();
            hideSentMailsFolder();
            hideComposeEmail();
            showReadEmail();

            var data = {
                'mails_to_user_id': $(this).parent().attr('data-mails-to-user-id')
            }

            $.ajax({
                url: serverUrl + '/admin/mail/info',
                dataType: 'json',
                method: 'POST',
                data: data,
                success: function (data, response) {
                    console.log(data);
                    if (data.status == "success") {
                        $('#mail_subject').append(data.result.mail.subject);
                        $('#mail_sent_by').append(data.result.user_send_by_details.first_name + ' ' + data.result.user_send_by_details.last_name + ' (' + data.result.user_send_by.email + ')');
                        $('#mail_sent_at').append(moment(data.result.mail_to_user.send_at).format('LLL'));
                        $('#mail_message_content').append(data.result.mail.message);
                    }
                },
                error: function (data) {
                }
            });
        });

        // on click send mail folder button ............show sent mails only and hide other things
        $('#button-folder-sent-mails').on('click', function (e) {
            e.preventDefault();

            hideInboxFolder();
            showSentMailsFolder();
            hideComposeEmail();
            hideReadEmail();
        });

        // on click on compose mail button ........hide inbox and any opened email
        $('.btn-compose').on('click', function (e) {
            e.preventDefault();

            hideInboxFolder();
            hideSentMailsFolder();
            showComposeEmail();
            hideReadEmail();
        });

        // send new mail
        $('.compose-new-email').on('click', '#send_new_mail', function (e) {
            e.preventDefault();

            var data = {
                'recipients': $(".search-select").val(),
                'subject': $(this).parentsUntil('panel-body').find('input[name="subject"]').val(),
                'message': $(this).parentsUntil('panel-body').find('textarea[name="message"]').val()
            }

            $.ajax({
                url: serverUrl + '/admin/compose/mail',
                dataType: 'json',
                method: 'POST',
                data: data,
                success: function (data, response) {
                    toastr.success('You have successfully send your mail to recipients');
                },
                error: function (data) {
                    toastr.info('Sorry, something happened. You cant send mail now.');
                }
            });

            $(".search-select").select2('val', "");
            $(this).parentsUntil('panel-body').find('input[name="subject"]').val('');
            $(this).parentsUntil('panel-body').find('textarea[name="message"]').val('');

            showInboxFolder();
            hideSentMailsFolder();
            hideComposeEmail();
            hideReadEmail();

            oTable.fnClearTable();

            attachInboxMails(oTable);
        });

        // on click on button inbox button ...........hide any compose email section and any opened email
        $('#button-folder-inbox').on('click', function (e) {
            e.preventDefault();

            oTable.fnClearTable();

            showInboxFolder();
            hideSentMailsFolder();
            hideComposeEmail();
            hideReadEmail();

            attachInboxMails(oTable);
        });

        attachInboxMails(oTable);
    };

    function showInboxFolder() {
        $('.inbox-incoming-mails').removeClass('no-display');
    }

    function hideInboxFolder() {
        $('.inbox-incoming-mails').addClass('no-display');
    }

    function showSentMailsFolder() {
        $('.inbox-sent-mails').removeClass('no-display');
    }

    function hideSentMailsFolder() {
        $('.inbox-sent-mails').addClass('no-display');
    }

    function showReadEmail() {
        $('.read-mails').removeClass('no-display');
    }

    function hideReadEmail() {
        $('.read-mails').addClass('no-display');

        $('#mail_subject').text('');
        $('#mail_sent_by').text('');
        $('#mail_sent_at').text('');
        $('#mail_message_content').text('');
    }

    function showComposeEmail() {
        $('.compose-new-email').removeClass('no-display');
    }

    function hideComposeEmail() {
        $('.compose-new-email').addClass('no-display');
    }

    var runSelect2 = function () {

        $(".search-select").select2({
            ajax: {
                url: serverUrl + '/admin/get/school/users',
                dataType: 'json',
                delay: 250,
                method: 'POST',
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.result,
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            InboxMailsTable();
            runSelect2();
        }
    };
}();
