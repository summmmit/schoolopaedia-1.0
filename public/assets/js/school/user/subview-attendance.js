var SVAttendance = function() {
    "use strict";
    //set variables	
    var date = new Date(),
            dateToShow = date,
            calendar, $eventDetail, eventClass, eventCategory;
    var subViewElement, subViewContent, subViewIndex;
    //validate new event form
    var runEventFormValidation = function(el) {
        var formEvent = $('.form-event');
        var errorHandler2 = $('.errorHandler', formEvent);
        var successHandler2 = $('.successHandler', formEvent);

        formEvent.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.parent().hasClass("input-icon")) {

                    error.insertAfter($(element).parent());
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                eventName: {
                    minlength: 2,
                    required: true
                },
                eventStartDate: {
                    required: true,
                    date: true
                },
                eventEndDate: {
                    required: true,
                    date: true
                }
            },
            messages: {
                eventName: "* Please specify your first name"

            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function(element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function(element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function(label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function(form) {
                successHandler2.show();
                errorHandler2.hide();
                var newEvent = new Object;
                newEvent.start = new Date($('.form-event .event-start-date').val());
                newEvent.end = new Date($('.form-event .event-end-date').val());
                newEvent.allDay = $(".form-event .all-day").bootstrapSwitch('state');
                if ($eventDetail.code() !== "" && $eventDetail.code().replace(/(<([^>]+)>)/ig, "") !== "" && $eventDetail.code() !== $eventDetail.attr("placeholder")) {
                    newEvent.content = $eventDetail.code();
                } else {
                    newEvent.content = "";
                }

                console.log(newEvent);

                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Do some ajax to sync with backend...'
                });

                $.ajax({
                    url: 'http://localhost/projects/schools/public/user/attendance/new/application/leave',
                    data: newEvent,
                    dataType: 'json',
                    method: 'POST',
                    success: function(data) {
                        $.unblockUI();
                            $.hideSubview();
                            toastr.success('A new event has been added to your calendar!');
                    }
                });


            }
        });
    };
    // on hide event's form destroy summernote and bootstrapSwitch plugins
    var hideEditEvent = function() {
        $.hideSubview();
        $('.form-event .summernote').destroy();
        $(".form-event .all-day").bootstrapSwitch('destroy');

    };
    // enables the edit form 
    var editEvent = function(el) {
        $(".close-new-event").off().on("click", function() {
            $(".back-subviews").trigger("click");
        });
        $(".form-event .help-block").remove();
        $(".form-event .form-group").removeClass("has-error").removeClass("has-success");
        $eventDetail = $('.form-event .summernote');

        $eventDetail.summernote({
            oninit: function() {
                if ($eventDetail.code() == "" || $eventDetail.code().replace(/(<([^>]+)>)/ig, "") == "") {
                    $eventDetail.code($eventDetail.attr("placeholder"));
                }
            },
            onfocus: function(e) {
                if ($eventDetail.code() == $eventDetail.attr("placeholder")) {
                    $eventDetail.code("");
                }
            },
            onblur: function(e) {
                if ($eventDetail.code() == "" || $eventDetail.code().replace(/(<([^>]+)>)/ig, "") == "") {
                    $eventDetail.code($eventDetail.attr("placeholder"));
                }
            },
            onkeyup: function(e) {
                $("span[for='detailEditor']").remove();
            },
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
        if (typeof el == "undefined") {
            $(".form-event .event-id").val("");
            $(".form-event .event-name").val("");
            $(".form-event .all-day").bootstrapSwitch('state', false);
            $('.form-event .all-day-range').hide();
            $(".form-event .event-start-date").val(moment());
            $(".form-event .event-end-date").val(moment().add('days', 1));

            $('.form-event .no-all-day-range .event-range-date').val(moment().format('MM/DD/YYYY') + ' - ' + moment().add('days', 1).format('MM/DD/YYYY'))
                    .daterangepicker({
                        startDate: moment(),
                        endDate: moment().add('days', 1),
                        timePicker: false,
                        timePickerIncrement: 30,
                        format: 'MM/DD/YYYY'
                    });

            $('.form-event .all-day-range .event-range-date').val(moment().format('MM/DD/YYYY') + ' - ' + moment().add('days', 1).format('MM/DD/YYYY'))
                    .daterangepicker({
                        startDate: moment(),
                        endDate: moment().add('days', 1)
                    });

            $('.form-event .event-categories option').filter(function() {
                return ($(this).text() == "Generic");
            }).prop('selected', true);
            $('.form-event .event-categories').selectpicker('render');
            $eventDetail.code($eventDetail.attr("placeholder"));

        } else {

            $(".form-event .event-id").val(el);

            for (var i = 0; i < calendar.length; i++) {

                if (calendar[i]._id == el) {
                    $(".form-event .event-name").val(calendar[i].title);
                    $(".form-event .all-day").bootstrapSwitch('state', calendar[i].allDay);
                    $(".form-event .event-start-date").val(moment(calendar[i].start));
                    $(".form-event .event-end-date").val(moment(calendar[i].end));
                    if (typeof $('.form-event .no-all-day-range .event-range-date').data('daterangepicker') == "undefined") {
                        $('.form-event .no-all-day-range .event-range-date').val(moment(calendar[i].start).format('MM/DD/YYYY h:mm A') + ' - ' + moment(calendar[i].end).format('MM/DD/YYYY h:mm A'))
                                .daterangepicker({
                                    startDate: moment(moment(calendar[i].start)),
                                    endDate: moment(moment(calendar[i].end)),
                                    timePicker: true,
                                    timePickerIncrement: 10,
                                    format: 'MM/DD/YYYY h:mm A'
                                });

                        $('.form-event .all-day-range .event-range-date').val(moment(calendar[i].start).format('MM/DD/YYYY') + ' - ' + moment(calendar[i].end).format('MM/DD/YYYY'))
                                .daterangepicker({
                                    startDate: moment(calendar[i].start),
                                    endDate: moment(calendar[i].end)
                                });
                    } else {
                        $('.form-event .no-all-day-range .event-range-date').val(moment(calendar[i].start).format('MM/DD/YYYY h:mm A') + ' - ' + moment(calendar[i].end).format('MM/DD/YYYY h:mm A'))
                                .data('daterangepicker').setStartDate(moment(moment(calendar[i].start)));
                        $('.form-event .no-all-day-range .event-range-date').data('daterangepicker').setEndDate(moment(moment(calendar[i].end)));
                        $('.form-event .all-day-range .event-range-date').val(moment(calendar[i].start).format('MM/DD/YYYY') + ' - ' + moment(calendar[i].end).format('MM/DD/YYYY'))
                                .data('daterangepicker').setStartDate(calendar[i].start);
                        $('.form-event .all-day-range .event-range-date').data('daterangepicker').setEndDate(calendar[i].end);
                    }

                    if (calendar[i].category == "" || typeof calendar[i].category == "undefined") {
                        eventCategory = "Generic";
                    } else {
                        eventCategory = calendar[i].category;
                    }
                    $('.form-event .event-categories option').filter(function() {
                        return ($(this).text() == eventCategory);
                    }).prop('selected', true);
                    $('.form-event .event-categories').selectpicker('render');
                    if (typeof calendar[i].content !== "undefined" && calendar[i].content !== "") {
                        $eventDetail.code(calendar[i].content);
                    } else {
                        $eventDetail.code($eventDetail.attr("placeholder"));
                    }
                }

            }
        }
        $('.form-event .all-day').bootstrapSwitch();

        $('.form-event .all-day').on('switchChange.bootstrapSwitch', function(event, state) {
            $(".daterangepicker").hide();
            var startDate = moment($("#newEvent").find(".event-start-date").val());
            var endDate = moment($("#newEvent").find(".event-end-date").val());
            if (state) {
                $("#newEvent").find(".no-all-day-range").hide();
                $("#newEvent").find(".all-day-range").show();
                $("#newEvent").find('.all-day-range .event-range-date').val(startDate.format('MM/DD/YYYY') + ' - ' + endDate.format('MM/DD/YYYY')).data('daterangepicker').setStartDate(startDate);
                $("#newEvent").find('.all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
            } else {
                $("#newEvent").find(".no-all-day-range").show();
                $("#newEvent").find(".all-day-range").hide();
                $("#newEvent").find('.no-all-day-range .event-range-date').val(startDate.format('MM/DD/YYYY h:mm A') + ' - ' + endDate.format('MM/DD/YYYY h:mm A')).data('daterangepicker').setStartDate(startDate);
                $("#newEvent").find('.no-all-day-range .event-range-date').data('daterangepicker').setEndDate(endDate);
            }

        });
        $('.form-event .event-range-date').on('apply.daterangepicker', function(ev, picker) {
            $(".form-event .event-start-date").val(picker.startDate);
            $(".form-event .event-end-date").val(picker.endDate);
        });
    };

    var runSubViews = function() {
        $(".new-note").off().on("click", function() {
            subViewElement = $(this);
            subViewContent = subViewElement.attr('href');
            $.subview({
                content: subViewContent,
                onShow: function() {
                    editNote();
                },
                onClose: function() {
                    checkNote();
                },
                onHide: function() {
                    hideNote();
                }
            });
        });
        $(".new-event").off().on("click", function() {
            subViewElement = $(this);
            subViewContent = subViewElement.attr('href');
            $.subview({
                content: subViewContent,
                onShow: function() {
                    editEvent();
                },
                onHide: function() {
                    hideEditEvent();
                }

            });
        });
        $(".close-subview-button").off().on("click", function(e) {
            $(".close-subviews").trigger("click");
            e.preventDefault();
        });
    };
    return {
        init: function() {
            runEventFormValidation();
            runSubViews();
        }
    };
}();