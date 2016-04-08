$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(function () {
    'use strict';


    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/ajax/upload',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#fileupload').append($('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'images[]')
                    .attr('value', file.name));
            });
        }
    });

    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });

    $('.ajax-button').on('click', function (e) {
        $.post('/ajax/getList', {id: 2, name: 'Vasya'}, function (data) {
            $('#result').html(data);
        });
    });


});
