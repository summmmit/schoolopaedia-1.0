$(function() {
    $.fn.editable.defaults.mode = 'inline';

    //enable / disable
    $('#enable').click(function(e) {
        e.stopPropagation();
        $('.editable').editable('toggleDisabled');
    });

    //editables 
    $('.opening-time').editable({
        validate: function(value) {
            if ($.trim(value) == '')
                return 'Value is required.';
        },
        url: 'http://localhost/projects/schools/public/administrator/admin/ajax/school/timings/start/from',
        title: 'Edit Start_from',
        type: 'text',
        send: 'always',
        ajaxOptions: {
            dataType: 'json'
        }
    });
    $('.lunch-time').editable({
        validate: function(value) {
            if ($.trim(value) == '')
                return 'Value is required.';
        },
        url: 'http://localhost/projects/schools/public/administrator/admin/ajax/school/timings/lunch/from',
        title: 'Edit Start_from',
        type: 'text',
        send: 'always',
        ajaxOptions: {
            dataType: 'json'
        }
    });
    $('.closing-time').editable({
        validate: function(value) {
            if ($.trim(value) == '')
                return 'Value is required.';
        },
        url: 'http://localhost/projects/schools/public/administrator/admin/ajax/school/timings/close/from',
        title: 'Edit Start_from',
        type: 'text',
        send: 'always',
        ajaxOptions: {
            dataType: 'json'
        }
    });
});