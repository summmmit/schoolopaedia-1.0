
var localServer = 'http://localhost/projects/web/public';
//var localServer = env(MAIL_HOST);
//var ProductionServer;
var serverUrl = localServer;

const Administrator = 1;
const Student = 2;
const Teacher = 3;

var weekDays = [
    {
        code: '1',
        name: 'Monday'
    },
    {
        code: '2',
        name: 'Tueday'
    },
    {
        code: '3',
        name: 'Wednesday'
    },
    {
        code: '4',
        name: 'Thrusday'
    },
    {
        code: '5',
        name: 'Friday'
    },
    {
        code: '6',
        name: 'Saturday'
    },
    {
        code: '7',
        name: 'Sunday'
    }
];

var months = [
    {
        code: '1',
        name: 'January'
    },
    {
        code: '2',
        name: 'February'
    },
    {
        code: '3',
        name: 'March'
    },
    {
        code: '4',
        name: 'April'
    },
    {
        code: '5',
        name: 'May'
    },
    {
        code: '6',
        name: 'June'
    },
    {
        code: '7',
        name: 'July'
    },
    {
        code: '8',
        name: 'August'
    },
    {
        code: '9',
        name: 'september'
    },
    {
        code: '10',
        name: 'October'
    },
    {
        code: '11',
        name: 'November'
    },
    {
        code: '12',
        name: 'December'
    }
];

// constants for inbox folders

const FOLDER_INBOX = 'Inbox';
const FOLDER_INBOX_ID = 1;

const FOLDER_SENT_MAILS = 'Sent Mails';
const FOLDER_SENT_MAILS_ID = 2;

const FOLDER_IMPORTANT = 'Important';
const FOLDER_IMPORTANT_ID = 3;

const FOLDER_TRASH = 'Trash';
const FOLDER_TRASH_ID = 4;

const USER_MADE_FOLDER = 9;


