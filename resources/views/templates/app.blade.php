<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('metatitle')</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="/assets/frontend/css/qunit-1.14.0.css">
    <link rel="stylesheet" href="/assets/frontend/css/qunit-1.14.0.css">
    <link rel="stylesheet" href="/jupload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/jupload/css/jquery.fileupload-ui.css">

    <script src="/assets/frontend/js/jquery.min.js"></script>
    <script src="/assets/frontend/js/bootstrap.min.js"></script>


    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/jupload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/jupload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/jupload/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="/jupload/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="/jupload/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload audio preview plugin -->
    <script src="/jupload/js/jquery.fileupload-audio.js"></script>
    <!-- The File Upload video preview plugin -->
    <script src="/jupload/js/jquery.fileupload-video.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="/jupload/js/jquery.fileupload-validate.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="/jupload/js/jquery.fileupload-ui.js"></script>

    <script src="/assets/frontend/custom.js"></script>
</head>
<body>
@include('partials._nav')
@include('partials._messages')
<div class="container">
        @yield('content')
</div>
</body>
</html>