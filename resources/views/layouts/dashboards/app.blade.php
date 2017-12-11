<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title> @yield('title') </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Preview page of Metronic Admin Theme #1 for Metronic's custom grid system" name="description"/>
        <meta content="" name="author"/>
        {!! Html::style('css/app.css') !!}
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
        {!! Html::script('js/app.js') !!}
    </body>
</html>