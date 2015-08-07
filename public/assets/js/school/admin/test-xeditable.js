$(function() {
    $.fn.editable.defaults.mode = 'inline';

    //editables 
    $('#username').editable({
        dataType: 'json',
        url: 'http://localhost/projects/schools/public/administrator/admin/school/timings'
    });
});