$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(function () {
    'use strict';
    var imageContainer = $('#fileupload');
    if (imageContainer.length > 0) {
        // Initialize the jQuery File Upload widget:
        imageContainer.fileupload({
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

        imageContainer.fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            )
        );
        // Load existing files:
        imageContainer.addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: imageContainer.fileupload('option', 'url'),
            dataType: 'json',
            context: imageContainer[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });

    }
});

$(function () {

    $('.ajax-button').on('click', function (e) {
        var first = $('input[name=first]').val();
        var second = $('input[name=second]').val();
        $.post('/ajax/getSum', {first: first, second: second}, function (data) {
            $('#result').html(data);
        });
    });

    $('.work_create_form').on('submit', function () {
        var self = $(this);
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            if (data.success == true)
                alert(data.message);
            self.trigger('reset');
        }).error(function (errors) {
            var errors = JSON.parse(errors.responseText);
            var str = '';
            $.each(errors, function (k, v) {
                str += v[0] + '\r';
            });
            self.find('*[name=' + Object.keys(errors)[0] + ']').focus();
            alert(str);
        });
        return false;
    });

    $('.work_edit_form').on('submit', function () {
        var self = $(this);
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            if (data.success == true)
                alert(data.message);
        }).error(function (errors) {
            var errors = JSON.parse(errors.responseText);
            var str = '';
            $.each(errors, function (k, v) {
                str += v[0] + '\r';
            });
            self.find('*[name=' + Object.keys(errors)[0] + ']').focus();
            alert(str);
        });
        return false;
    });

});
