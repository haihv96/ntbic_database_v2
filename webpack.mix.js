let mix = require('laravel-mix');

mix.disableNotifications();

mix.js('resources/assets/js/main.js', 'public/js')
    .sass('resources/assets/sass/main.scss', 'public/css');

mix.scripts([
        'public/themes/metronic/assets/js/jquery.min.js',
        'public/themes/metronic/assets/js/bootstrap.min.js',
        'public/themes/metronic/assets/js/js.cookie.min.js',
        'public/themes/metronic/assets/js/jquery.slimscroll.min.js',
        'public/themes/metronic/assets/js/jquery.blockui.min.js',
        'public/themes/metronic/assets/js/app.min.js',
        'public/themes/metronic/assets/js/layout.min.js',
        'public/themes/metronic/assets/js/demo.min.js',
        'public/themes/metronic/assets/js/quick-sidebar.min.js',
        'public/themes/metronic/assets/js/quick-nav.min.js',
        'public/themes/metronic/assets/js/toastr.min.js',
        'public/tinymce/js/tinymce/tinymce.min.js',
        'public/js/main.js'
    ],
    'public/js/app.js')
    .styles([
            '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
            'public/themes/metronic/assets/css/bootstrap.min.css',
            'public/themes/metronic/assets/css/bootstrap-switch.min.css',
            'public/themes/metronic/assets/css/components.min.css',
            'public/themes/metronic/assets/css/plugins.min.css',
            'public/themes/metronic/assets/css/layout.min.css',
            'public/themes/metronic/assets/css/darkblue.min.css',
            'public/themes/metronic/assets/css/custom.min.css',
            'public/themes/metronic/assets/css/toastr.min.css',
            'public/css/main.css'
        ],
        'public/css/app.css');