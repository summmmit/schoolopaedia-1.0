/**
 * Created by Sumit Singh on 2015/11/05.
 */
var InboxSettings = function () {

    var inboxPage = function () {

        // on click on any mail ...hide compose email and inbox .
        $('#table-inbox-incoming-mails,#table-inbox-sent-mails').on('click', 'trhh', function (e) {
            e.preventDefault();

            //hideInboxHeader();
            //hideComposeEmail();
            //hideInboxFolder();
            //hideSentMailsFolder();
            //showReadEmail();
        });

    }
    var getSentMails = function () {

        $('#table-inbox-sent-mails').find('tbody').empty();

        $.ajax({
            url: serverUrl + '/admin/get/all/sent/mails',
            dataType: 'json',
            method: 'POST',
            success: function (data, response) {
                console.log(data);
                for(var i = 0; i<data.result.length; i++){

                    var inboxMailRow = '<tr class="unread"><td class="inbox-small-cells"><input name="'+ data.result[i].id +'" type="checkbox" class="mail-checkbox"></td>' +
                        '<td class="inbox-small-cells"><i class="fa fa-star"></i></td><td class="view-message  dont-show">'+ data.result[i].subject +'</td>' +
                        '<td class="view-message ">'+ data.result[i].message +'</td>' +
                        '<td class="view-message  text-right">'+ data.result[i].created_at +'</td></tr>';

                    $('#table-inbox-sent-mails').find('tbody').prepend(inboxMailRow);
                }
            },
            error: function (data) {
            }
        });
    };
    return {
        init: function () {
            inboxPage();
        }
    }
}();