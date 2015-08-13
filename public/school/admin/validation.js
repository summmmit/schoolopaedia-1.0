var Validation = function() {
    "use strict";
    var validateCheckRadio = function(val) {
        $("input[type='radio'], input[type='checkbox']").on('ifChecked', function(event) {
            $(this).parent().closest(".has-error").removeClass("has-error").addClass("has-success").find(".help-block").hide().end().find('.symbol').addClass('ok');
        });
    };
    // function to initiate Validation
    var runValidator1 = function() {
        var form1 = $('#form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $.validator.addMethod("FullDate", function() {
            //if all values are selected
            if ($("#dd").val() != "" && $("#mm").val() != "" && $("#yyyy").val() != "") {
                return true;
            } else {
                return false;
            }
        }, 'Please select a day, month, and year');
        $('#form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else if (element.hasClass('date-picker')) {
                    error.insertAfter($(element).closest('.form-group').children('.input-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                start_session_from: {
                    required: true
                },
                end_session_untill: {
                    minlength: 2,
                    required: true
                },
                last_name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile_number: {
                    required: true,
                    number: true,
                    minlength: 10
                },
                password: {
                    minlength: 6,
                    required: true
                },
                password_again: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                yyyy: "FullDate",
                sex: {
                    required: true
                },
                marriage_status: {
                    required: true
                },
                relative_id: {
                    required: true
                },
                relation_with_person: {
                    required: true
                },
                add_1: {
                    minlength: 2,
                    required: true
                },
                add_2: {
                    minlength: 2
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },
                pin_code: {
                    required: true,
                    number: true,
                    minlength: 5
                },
                newsletter: {
                    required: true
                },
                period_name: {
                    required: true
                }
            },
            messages: {
                first_name: "Please specify your First name",
                last_name: "Please specify your Last name",
                mobile_number: "Please specify your Mobile Number in the (99-9999-9999) Format",
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                gender: "Please check a gender!",
                marriage_status: "Please check your Marriage Status!",
                relative_id: "Please Give Voter Id of Your Father / Husband!",
                relation_with_person: "Please Check Whose Voter Id you have Give Father or Husband!"
            },
            groups: {
                DateofBirth: "dd mm yyyy"
            },
            invalidHandler: function(event, validator) { //display error alert on form submit
                successHandler1.hide();
                errorHandler1.show();
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
                successHandler1.show();
                errorHandler1.hide();
                // submit form
                form.submit();
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function() {
            validateCheckRadio();
            runValidator1();
        }
    };
}();