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
                if (e.isDefaultPrevented()) {
                    return false;
                }
                var that = $(this).data('blueimp-fileupload') ||
                        $(this).data('fileupload'),
                    getFilesFromResponse = data.getFilesFromResponse ||
                        that.options.getFilesFromResponse,
                    files = getFilesFromResponse(data),
                    template,
                    deferred;
                if (data.context) {
                    data.context.each(function (index) {
                        var file = files[index] ||
                            {error: 'Empty file upload result'};
                        deferred = that._addFinishedDeferreds();
                        that._transition($(this)).done(
                            function () {
                                var node = $(this);
                                template = that._renderDownload([file])
                                    .replaceAll(node);
                                that._forceReflow(template);
                                that._transition(template).done(
                                    function () {
                                        data.context = $(this);
                                        that._trigger('completed', e, data);
                                        that._trigger('finished', e, data);
                                        deferred.resolve();
                                    }
                                );
                            }
                        );
                    });
                } else {
                    template = that._renderDownload(files)[
                        that.options.prependFiles ? 'prependTo' : 'appendTo'
                        ](that.options.filesContainer);
                    that._forceReflow(template);
                    deferred = that._addFinishedDeferreds();
                    that._transition(template).done(
                        function () {
                            data.context = $(this);
                            that._trigger('completed', e, data);
                            that._trigger('finished', e, data);
                            deferred.resolve();
                        }
                    );
                }
            },
            autoUpload: true
        });

        imageContainer.on('click', '.delete', function (e) {
            var fileName = $(this).closest('tr').find('p.name').find('a').attr('title');
            imageContainer.find('input[value=\'' + fileName + '\']').remove();
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
            data: {work_id: $('#work_id').text()},
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

    //$('.work_create_form').on('submit', function () {
    //    var self = $(this);
    //    $.post($(this).attr('action'), $(this).serialize(), function (data) {
    //        if (data.success == true)
    //            alert(data.message);
    //        self.trigger('reset');
    //    }).error(function (errors) {
    //        var errors = JSON.parse(errors.responseText);
    //        var str = '';
    //        $.each(errors, function (k, v) {
    //            str += v[0] + '\r';
    //        });
    //        self.find('*[name=' + Object.keys(errors)[0] + ']').focus();
    //        alert(str);
    //    });
    //    return false;
    //});
    //
    //$('.work_edit_form').on('submit', function () {
    //    var self = $(this);
    //    $.post($(this).attr('action'), $(this).serialize(), function (data) {
    //        if (data.success == true)
    //            alert(data.message);
    //    }).error(function (errors) {
    //        var errors = JSON.parse(errors.responseText);
    //        var str = '';
    //        $.each(errors, function (k, v) {
    //            str += v[0] + '\r';
    //        });
    //        self.find('*[name=' + Object.keys(errors)[0] + ']').focus();
    //        alert(str);
    //    });
    //    return false;
    //});

});
