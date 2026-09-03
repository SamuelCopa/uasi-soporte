<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'UASI',
    'title_prefix' => 'GAMEA',
    'title_postfix' => 'SOPORTE',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>UASI</b> SOPORTE',
    'logo_img' => 'vendor/adminlte/dist/img/logogamea.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    // 'auth_logo' => [
    //     'enabled' => false,
    //     'img' => [
    //         'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    //         'alt' => 'Auth Logo',
    //         'class' => '',
    //         'width' => 50,
    //         'height' => 50,
    //     ],
    // ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    // 'preloader' => [
    //     'enabled' => true,
    //     'mode' => 'fullscreen',
    //     'img' => [
    //         'path' => 'img1/logogamea.png',
    //         'alt' => 'AdminLTE Preloader Image',
    //         'effect' => 'animation__shake',
    //         'width' => 90,
    //         'height' => 90,
    //     ],
    // ],

'preloader' => [
    'enabled' => true,
    'mode' => 'fullscreen',
    'img' => [
        'path' => 'img1/logogamea.png',
        'alt' => 'UASI Soporte',
        'effect' => 'animation__swing-rotate',

        'width' => 90,
        'height' => 90,
    ],
],



    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => '',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,


    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar  navbar-elegante',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',


    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 's',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

'menu' => [

// =========================================================
// NAVBAR
// =========================================================
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],
        [
            'text' => 'Inicio',
            'url'  => '/home',
            'icon' => 'fas fa-fw fa-home',
            'topnav' => true,
        ],

        [
            'text' => 'Soporte Técnico',
            'url'  => '/servicios',
            'icon' => 'fas fa-fw fa-headset',
            'topnav' => true,
            'can' => ['superadministrador', 'admin'],
        ],

        [
            'text' => 'Mis asignaciones',
            'url'  => '/asignaciones/asistencia',
            'icon' => 'fas fa-fw fa-tasks',
            'topnav' => true,
            'can' => 'tecnico',
        ],

        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

// [
//     'text' => '',
//     'url'  => '/servicios',
//     'icon' => 'fas fa-fw fa-bell',
//     'topnav_right' => true,
//     'label' => 3,
//     'label_color' => 'danger',
//     'can' => ['superadministrador', 'admin'],
// ],

    // =========================================================
    // PANEL PRINCIPAL
    // =========================================================
    [
        'header' => 'INICIO',
    ],
    [
        'text'  => 'Panel principal',
        'route' => 'home',
        'icon'  => 'fas fa-fw fa-tachometer-alt',
    ],

    // =========================================================
    // PERSONAL
    // =========================================================
    [
        'header' => 'GESTIÓN DE PERSONAL',
        'can'  => ['superadministrador', 'admin'],
    ],
    [
        'text' => 'Personal',
        'icon' => 'fas fa-fw fa-users',
        'can'  => ['superadministrador', 'admin'],

        'submenu' => [

            [
                'text' => 'Responsables',
                'url'  => '/users',
                'icon' => 'fas fa-fw fa-user',
                'can'  => 'superadministrador',
            ],

            [
                'text' => 'Técnicos',
                'url'  => '/tecnicos',
                'icon' => 'fas fa-fw fa-user-cog',
            ],

        ],
    ],

    // =========================================================
    // EQUIPOS
    // =========================================================

    [
        'header' => 'GESTIÓN DE EQUIPOS',
        'can'  => ['admin', 'tecnico'],
    ],


    [
        'text' => 'Activos',
        'icon' => 'fas fa-fw fa-folder-open',
        'can'  => ['admin', 'tecnico'],

        'submenu' => [

            [
                'text' => 'Audífonos',
                'url'  => '/audifonos',
                'icon' => 'fas fa-fw fa-headphones',
            ],

            [
                'text' => 'CPU',
                'url'  => '/registro-cpus',
                'icon' => 'fas fa-fw fa-desktop',
            ],

            [
                'text' => 'Estabilizador',
                'url'  => '/estabilizadors',
                'icon' => 'fas fa-fw fa-bolt',
            ],

            [
                'text' => 'Impresora',
                'url'  => '/impresoras',
                'icon' => 'fas fa-fw fa-print',
            ],

            [
                'text' => 'Laptops',
                'url'  => '/laptops',
                'icon' => 'fas fa-fw fa-laptop',
            ],

            [
                'text' => 'Monitor',
                'url'  => '/monitors',
                'icon' => 'fas fa-fw fa-desktop',
            ],

            [
                'text' => 'Mouse',
                'url'  => '/ratons',
                'icon' => 'fas fa-fw fa-mouse',
            ],

            [
                'text' => 'Parlante',
                'url'  => '/parlantes',
                'icon' => 'fas fa-fw fa-volume-up',
            ],

            [
                'text' => 'Teclado',
                'url'  => '/teclados',
                'icon' => 'fas fa-fw fa-keyboard',
            ],

            [
                'text' => 'UPS',
                'url'  => '/upeses',
                'icon' => 'fas fa-fw fa-battery-full',
            ],

            [
                'text' => 'Otros equipos',
                'url'  => '/otros-equipos',
                'icon' => 'fas fa-fw fa-boxes',
            ],

        ],
    ],

    // =========================================================
    // MIS ASIGNACIONES DE EQUIPOS
    // =========================================================

    [
        'text' => 'Mis asignaciones',
        'icon' => 'fas fa-fw fa-user-clock',
        'can'  => 'tecnico',

        'submenu' => [

            [
                'text' => 'Audífono',
                'url'  => '/asignaciones/audifono',
                'icon' => 'fas fa-fw fa-headphones',
            ],

            [
                'text' => 'CPU',
                'url'  => '/asignaciones/cpu',
                'icon' => 'fas fa-fw fa-desktop',
            ],

            [
                'text' => 'Estabilizador',
                'url'  => '/asignaciones/estabilizador',
                'icon' => 'fas fa-fw fa-bolt',
            ],

            [
                'text' => 'Impresora',
                'url'  => '/asignaciones/impresora',
                'icon' => 'fas fa-fw fa-print',
            ],

            [
                'text' => 'Laptop',
                'url'  => '/asignaciones/laptop',
                'icon' => 'fas fa-fw fa-laptop',
            ],

            [
                'text' => 'Monitor',
                'url'  => '/asignaciones/monitor',
                'icon' => 'fas fa-fw fa-desktop',
            ],

            [
                'text' => 'Mouse',
                'url'  => '/asignaciones/mouse',
                'icon' => 'fas fa-fw fa-mouse',
            ],

            [
                'text' => 'Parlante',
                'url'  => '/asignaciones/parlante',
                'icon' => 'fas fa-fw fa-volume-up',
            ],

            [
                'text' => 'Teclado',
                'url'  => '/asignaciones/teclado',
                'icon' => 'fas fa-fw fa-keyboard',
            ],

            [
                'text' => 'UPS',
                'url'  => '/asignaciones/ups',
                'icon' => 'fas fa-fw fa-battery-full',
            ],

            [
                'text' => 'Otros equipos',
                'url'  => '/asignaciones/equipos',
                'icon' => 'fas fa-fw fa-boxes',
            ],

        ],
    ],

    // =========================================================
    // PIEZAS CPU
    // =========================================================
    [
        'header' => 'COMPONENTES',
        'can'  => 'admin1',
    ],
    [
        'text' => 'PIEZAS CPU',
        'icon' => 'fas fa-fw fa-cogs',
        'can'  => 'admin1',

        'submenu' => [

            // CASE
            [
                'text' => 'CASE',
                'icon' => 'fas fa-fw fa-desktop',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-cases',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Colores',
                        'url'  => '/color-cases',
                        'icon' => 'fas fa-fw fa-palette',
                    ],

                ],
            ],

            // PROCESADOR
            [
                'text' => 'PROCESADOR',
                'icon' => 'fas fa-fw fa-microchip',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-procesadors',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Modelo',
                        'url'  => '/modelo-procesadors',
                        'icon' => 'fas fa-fw fa-microchip',
                    ],

                    [
                        'text' => 'Generación',
                        'url'  => '/gen-procesadors',
                        'icon' => 'fas fa-fw fa-layer-group',
                    ],

                ],
            ],

            // TARJETA MADRE
            [
                'text' => 'TARJETA MADRE',
                'icon' => 'fas fa-fw fa-memory',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-tmadres',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                ],
            ],

            // DISCO DURO
            [
                'text' => 'DISCO DURO',
                'icon' => 'fas fa-fw fa-hdd',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-discos',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Modelo',
                        'url'  => '/modelo-discos',
                        'icon' => 'fas fa-fw fa-hdd',
                    ],

                    [
                        'text' => 'Capacidad',
                        'url'  => '/capacidad-discos',
                        'icon' => 'fas fa-fw fa-database',
                    ],

                    [
                        'text' => 'Tipo',
                        'url'  => '/tipo-discos',
                        'icon' => 'fas fa-fw fa-list',
                    ],

                ],
            ],

            // MEMORIA RAM
            [
                'text' => 'MEMORIA RAM',
                'icon' => 'fas fa-fw fa-memory',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-rams',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Capacidad',
                        'url'  => '/capacidad-rams',
                        'icon' => 'fas fa-fw fa-database',
                    ],

                    [
                        'text' => 'Tipo',
                        'url'  => '/tipo-rams',
                        'icon' => 'fas fa-fw fa-list',
                    ],

                    [
                        'text' => 'Cantidad',
                        'url'  => '/cantidad-rams',
                        'icon' => 'fas fa-fw fa-sort-numeric-up',
                    ],

                ],
            ],

            // TARJETA DE VIDEO
            [
                'text' => 'TARJETA DE VIDEO',
                'icon' => 'fas fa-fw fa-tv',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-tvideos',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Tipo',
                        'url'  => '/tipo-tvideos',
                        'icon' => 'fas fa-fw fa-list',
                    ],

                    [
                        'text' => 'Capacidad',
                        'url'  => '/capacidad-tvideos',
                        'icon' => 'fas fa-fw fa-database',
                    ],

                ],
            ],

            // TARJETA DE RED
            [
                'text' => 'TARJETA DE RED',
                'icon' => 'fas fa-fw fa-network-wired',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-treds',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Modelo',
                        'url'  => '/modelo-treds',
                        'icon' => 'fas fa-fw fa-network-wired',
                    ],

                ],
            ],

            // TARJETA WIFI
            [
                'text' => 'TARJETA WIFI',
                'icon' => 'fas fa-fw fa-wifi',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-twifis',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Modelo',
                        'url'  => '/modelo-wifis',
                        'icon' => 'fas fa-fw fa-wifi',
                    ],

                ],
            ],

            // FUENTE DE PODER
            [
                'text' => 'FUENTE DE PODER',
                'icon' => 'fas fa-fw fa-plug',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-fuentes',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                    [
                        'text' => 'Potencia',
                        'url'  => '/potencia-fuentes',
                        'icon' => 'fas fa-fw fa-bolt',
                    ],

                ],
            ],

            // LECTOR CD/DVD
            [
                'text' => 'LECTOR CD-DVD',
                'icon' => 'fas fa-fw fa-compact-disc',

                'submenu' => [

                    [
                        'text' => 'Marca',
                        'url'  => '/marca-lectorcds',
                        'icon' => 'fas fa-fw fa-tag',
                    ],

                ],
            ],

        ],
    ],

    // =========================================================
    // ASISTENCIA TÉCNICA
    // =========================================================
    [
        'header' => 'ASISTENCIA TÉCNICA',
    ],
    [
        'text' => 'Requerimiento de asistencia técnica',
        'url'  => '/servicios',
        'icon' => 'fas fa-fw fa-headset',
        'can'  => ['superadministrador', 'admin'],
    ],

    [
        'text' => 'Mis asignaciones de asistencia técnica',
        'url'  => '/asignaciones/asistencia',
        'icon' => 'fas fa-fw fa-user-cog',
        'can'  => 'tecnico',
    ],

    // =========================================================
    // OTROS
    // =========================================================
    [
        'header' => 'GESTIÓN ADMINISTRATIVA',
    ],
    [
        'text' => 'Otros',
        'icon' => 'fas fa-fw fa-file-alt',

        'submenu' => [

            [
                'text' => 'Funcionarios',
                'url'  => '/funcionarios',
                'icon' => 'fas fa-fw fa-users',
                'can'  => 'admin',
            ],

            [
                'text' => 'Términos y condiciones',
                'url'  => '/terminos/edit',
                'icon' => 'fas fa-fw fa-file-contract',
                'can'  => 'admin',
            ],

            [
                'text' => 'Modelos de cartas para solicitar mantenimiento',
                'url'  => '/documentos',
                'icon' => 'fas fa-fw fa-file-word',
                'can'  => 'admin',
            ],

            [
                'text' => 'Responsables',
                'url'  => '/responsables',
                'icon' => 'fas fa-fw fa-user-tie',
                'can'  => 'admin',
            ],

            [
                'text' => 'Dependencias',
                'url'  => '/dependencias',
                'icon' => 'fas fa-fw fa-building',
                'can'  => 'admin',
            ],

            [
                'text' => 'Manual de usuario',
                'url'  => '/manual-usuario',
                'icon' => 'fas fa-fw fa-book',
            ],

        ],
    ],

    // =========================================================
    // CONFIGURACIÓN
    // =========================================================

    [
        'header' => 'CONFIGURACIÓN',
    ],

    [
        'text' => 'Modo oscuro',
        'icon' => 'fas fa-fw fa-sun',
        'url'  => '#',
        'id'   => 'dark-mode-toggle',
    ],

[
    'header' => 'USUARIO',
],

[
    'type' => 'usermenu',
],

],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,

        //JeroenNoten\LaravelAdminLte\Menu\Filters\UsableHtmlFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',

                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',


                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.css',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,

    'providers' => [

	SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
],

    'aliases' => [

	'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class,
],
    
];
