<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for Metronic's custom grid system" name="description" />
        <meta content="" name="author" />
        {!! Html::style('themes/metronic/assets/css/bootstrap.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/bootstrap-switch.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/components.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/plugins.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/layout.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/darkblue.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/custom.min.css') !!}
        {!! Html::style('themes/metronic/assets/css/toastr.min.css') !!}
        {!! Html::style('css/admin.css') !!}
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            @include('layouts.dashboards.header')
            <div class="page-container">
                @include('layouts.dashboards.sidebar')
                @include('layouts.dashboards.container')
            </div>
            @include('layouts.dashboards.footer')
        </div>
        {!! Html::script('themes/metronic/assets/js/jquery.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/bootstrap.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/js.cookie.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/jquery.slimscroll.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/jquery.blockui.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/app.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/layout.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/demo.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/quick-sidebar.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/quick-nav.min.js') !!}
        {!! Html::script('themes/metronic/assets/js/toastr.min.js') !!}
        {!! Html::script('js/tinymce/tinymce.min.js') !!}
        {!! Html::script('js/admin.js') !!}
    </body>
</html>