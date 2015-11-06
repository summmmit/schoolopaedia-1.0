/**
 * Created by Sumit Singh on 2015/11/05.
 */
var InboxSettings = function () {

    var inboxPage = function () {

        // on click on any mail ...hide compose email and inbox .
        $('#table-inbox-incoming-mails,#table-inbox-sent-mails').on('click', 'tr', function (e) {
            e.preventDefault();

            hideInboxHeader();
            hideComposeEmail();
            hideInboxFolder();
            hideSentMailsFolder();
            showReadEmail();
        });

        // on click on compose mail button ........hide inbox and any opened email
        $('.btn-compose').on('click', function (e) {
            e.preventDefault();

            hideInboxHeader();
            hideInboxFolder();
            hideSentMailsFolder();
            hideReadEmail();
            showComposeEmail();
        });

        // on click on button inbox button ...........hide any compose email section and any opened email
        $('#button-folder-inbox').on('click', function (e) {
            e.preventDefault();

            showInboxHeader();
            showInboxFolder();
            hideSentMailsFolder();
            hideComposeEmail();
            hideReadEmail();
        });

        // on click send mail folder button ............show sent mails only and hide other things
        $('#button-folder-sent-mails').on('click', function (e) {
            e.preventDefault();

            showInboxHeader();
            showSentMailsFolder();
            hideComposeEmail();
            hideInboxFolder();
            hideReadEmail();
        });

        // send new mail
        $('.compose-new-email').on('click', '#send_new_mail', function(e){
            e.preventDefault();
            var data = {
                'recipients' : $(this).parentsUntil('panel-body').find('input[name="recipients"]').val(),
                'subject' : $(this).parentsUntil('panel-body').find('input[name="subject"]').val(),
                'message' : $(this).parentsUntil('panel-body').find('textarea[name="message"]').val()
            }

            $.ajax({
                url: serverUrl + '/admin/compose/mail',
                dataType: 'json',
                method: 'POST',
                data: data,
                success: function(data, response) {
                    toastr.success('You have successfully send your mail to recipients');
                },
                failed: function(data){

                }
            });

            $(this).parentsUntil('panel-body').find('input[name="recipients"]').val('');
            $(this).parentsUntil('panel-body').find('input[name="subject"]').val('');
            $(this).parentsUntil('panel-body').find('textarea[name="message"]').val('');

            showInboxHeader();
            showInboxFolder();
            hideSentMailsFolder();
            hideComposeEmail();
            hideReadEmail();
        });

    }

    function showInboxHeader() {
        $('.incoming-mails').removeClass('no-display');
    }

    function hideInboxHeader() {
        $('.incoming-mails').addClass('no-display');
    }

    function showInboxFolder() {
        $('#table-inbox-incoming-mails').removeClass('no-display');
    }

    function hideInboxFolder() {
        $('#table-inbox-incoming-mails').addClass('no-display');
    }

    function showSentMailsFolder() {
        $('#table-inbox-sent-mails').removeClass('no-display');
    }

    function hideSentMailsFolder() {
        $('#table-inbox-sent-mails').addClass('no-display');
    }

    function showReadEmail() {
        $('.read-mails').removeClass('no-display');
    }

    function hideReadEmail() {
        $('.read-mails').addClass('no-display');
    }

    function showComposeEmail() {
        $('.compose-new-email').removeClass('no-display');
    }

    function hideComposeEmail() {
        $('.compose-new-email').addClass('no-display');
    }

    return {
        init: function () {
            inboxPage();
        }
    }
}();