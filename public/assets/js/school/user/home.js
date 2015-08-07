var Home = function() {
    "use strict";
    var homeSettings = function() {

        function scheduleByDay() {
            var day = moment().day();
            console.log(day);
        }
        $('#table-daily-schedule');

    };

    return {
        //main function to initiate template pages
        init: function() {
            homeSettings();
        }
    };
}();