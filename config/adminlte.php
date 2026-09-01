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
        // Navbar items:
[
    'text' => 'UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN',

    'url'     => '#',
    'topnav'  => true,
    'icon'    => 'fas fa-cogs',
    'classes' => 'text-white px-2 py-1',
],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
      
        // ['header' => 'account_settings'],
        // [
        //     'text' => 'MI PERFIL',
        //     'url' => '',
        //     'icon' => 'fas fa-fw fa-user',
        // ],
        [
            'text' => 'PANEL PRINCIPAL',
            // 'classes' => 'text-blue text-bold',
            'url' => '/home',
            'icon' => 'fas fas fa-home',
            'icon_color' => '',
        ],
        [
            'text' => 'PERSONAL',
            // 'classes' => 'text-cyan text-bold',
            'icon' => 'fas fas fa-user',
            'can' => ['superadministrador','admin'],
            'submenu' => [
                [
                    'text' => 'RESPONSABLES',
                    'url' => '/users',
                    'icon' => 'fas fas fa-user',
                    'can' => 'superadministrador',
                ],
                [
                    'text' => 'TECNICOS',
                    'url' => '/tecnicos',
                    'icon' => 'fas fa-user-cog',
                ],
                [
                    'text' => 'TECLADOS',
                    //'url' => '/teclados',
                    'icon' => 'fas fas fa-keyboard',
                ],

            ],

        ],

        [
            'text' => 'REGISTRO DE ACTIVOS',
            // 'classes' => 'text-yellow text-bold',
            'icon' => 'fas fa-folder-open',
            'can' => ['admin', 'tecnico'],

            'submenu' => [
                [
                    'text' => 'AUDIFONOS',
                    'url' => '/audifonos',
                    'icon' => 'fas fas fa-headphones',
                ],
                [
                    'text' => 'CPU',
                    'url' => 'registro-cpus',
                    'icon' => 'fas fas fa-window-maximize',
                ],
                [
                    'text' => 'ESTABILIZADOR',
                    'url' => '/estabilizadors',
                    'icon' => 'fas fas fa-stop',
                ],
                [
                    'text' => 'IMPRESORAS',
                    'url' => '/impresoras',
                    'icon' => 'fa fa-print',
                ],
                [
                    'text' => 'LAPTOPS',
                    'url' => '/laptops',
                    'icon' => 'fas fas fa-laptop',
                ],
                [
                    'text' => 'MONITOR',
                    'url' => '/monitors',
                    'icon' => 'fas fas fa-desktop',
                ],
                [
                    'text' => 'MOUSE',
                    'url' => '/ratons',
                    'icon' => 'fas fa-fw fa-mouse',
                ],
                [
                    'text' => 'PARLANTES',
                    'url' => '/parlantes',
                    'icon' => 'fas fas fa-volume-up',
                ],
                [
                    'text' => 'TECLADOS',
                    'url' => '/teclados',
                    'icon' => 'fas fas fa-keyboard',
                ],
                [
                    'text' => 'UPS',
                    'url' => '/upeses',
                    'icon' => 'fas fas fa-hdd',
                ],
                [
                    'text' => 'OTROS EQUIPOS',
                    'url' => '/otros-equipos',
                    'icon' => 'fas fas fa-headphones',
                ],
            ],

        ],
        [
            'text' => 'MIS ASIGNACIONES',
            // 'classes' => 'text-primary text-bold',
            'icon' => 'fas fa-user-clock',
            'can' => 'tecnico',
            'submenu' => [
                [
                    'text' => 'AUDIFONOS',
                    'url' => '/asignaciones/audifono',
                    'icon' => 'fas fas fa-headphones',
                ],
                [
                    'text' => 'CPU',
                    'url' => '/asignaciones/cpu',
                    'icon' => 'fas fas fa-window-maximize',
                ],
                [
                    'text' => 'ESTABILIZADOR',
                    'url' => '/asignaciones/estabilizador',
                    'icon' => 'fas fas fa-stop',
                ],
                [
                    'text' => 'IMPRESORAS',
                    'url' => '/asignaciones/impresora',
                    'icon' => 'fa fa-print',
                ],
                [
                    'text' => 'LAPTOPS',
                    'url' => '/asignaciones/laptop',
                    'icon' => 'fas fas fa-laptop',
                ],
                [
                    'text' => 'MONITOR',
                    'url' => '/asignaciones/monitor',
                    'icon' => 'fas fas fa-desktop',
                ],
                [
                    'text' => 'MOUSE',
                    'url' => '/asignaciones/mouse',
                    'icon' => 'fas fa-fw fa-mouse',
                ],
                [
                    'text' => 'PARLANTES',
                    'url' => '/asignaciones/parlante',
                    'icon' => 'fas fas fa-volume-up',
                ],
                [
                    'text' => 'TECLADOS',
                    'url' => '/asignaciones/teclado',
                    'icon' => 'fas fas fa-keyboard',
                ],
                [
                    'text' => 'UPS',
                    'url' => '/asignaciones/ups',
                    'icon' => 'fas fas fa-hdd',
                ],
                [
                    'text' => 'OTROS EQUIPOS',
                    'url' => '/asignaciones/equipos',
                    'icon' => 'fas fas fa-hdd',
                ],
            ],

        ],

        [
            'text' => 'PIEZAS CPU',
            'icon' => 'fas fa-cog',
            'can' => 'admin1',
            'submenu' => [
                    [
                        'text' => 'CASE',
                        'icon' => 'fas fa-fw fa-stop',
                        'submenu' => [
                            [
                                'text' => 'MARCA',
                                'url' => '/marca-cases',
                                'icon_color' => 'red',
                            ],
                            [
                                'text' => 'COLORES',
                                'url' => '/color-cases',
                                //'can'=> 'administrador'
                            ],
                        ]
                    ],
                    [
                    'text' => 'PROCESADOR',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-procesadors',
                        ],
                        [
                            'text' => 'MODELO',
                            'url' => '/modelo-procesadors',
                        ],
                        [
                            'text' => 'GENERACIÓN',
                            'url' => '/gen-procesadors',
                        ],
                    ]
                ],
                [
                    'text' => 'TARJETA MADRE',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-tmadres',
                            'icon_color' => 'red',
                        ],
                    ]
                ],
                [
                    'text' => 'DISCO DURO',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-discos',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'MODELO',
                            'url' => '/modelo-discos',
                            //'can'=> 'administrador'
                        ],
                        [
                            'text' => 'CAPACIDAD',
                            'url' => '/capacidad-discos',
                            //'can'=> 'administrador'
                        ],
                        [
                            'text' => 'TIPO',
                            'url' => '/tipo-discos',
                            //'can'=> 'administrador'
                        ],
                    ]
                ],
                [
                    'text' => 'MEMORIA RAM',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-rams',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'CAPACIDAD',
                            'url' => '/capacidad-rams',
                            //'can'=> 'administrador'
                        ],
                        [
                            'text' => 'TIPO',
                            'url' => '/tipo-rams',
                            //'can'=> 'administrador'
                        ],
                        [
                            'text' => 'CANTIDAD',
                            'url' => '/cantidad-rams',
                            //'can'=> 'administrador'
                        ],
                    ]
                ],
                [
                    'text' => 'TARJETA DE VIDEO',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-tvideos',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'TIPO',
                            'url' => '/tipo-tvideos',
                            //'can'=> 'administrador'
                        ],
                        [
                            'text' => 'CAPACIDAD',
                            'url' => '/capacidad-tvideos',
                            //'can'=> 'administrador'
                        ],
                    ]
                ],
                [
                    'text' => 'TARJETA  DE RED',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-treds',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'MODELO',
                            'url' => '/modelo-treds',
                            'icon_color' => 'red',
                        ],
                    ]
                ],
                [
                    'text' => 'TARJETA  WIFI',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-twifis',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'MODELO',
                            'url' => '/modelo-wifis',
                            'icon_color' => 'red',
                        ],
                    ]
                ],
                [
                    'text' => 'FUENTE DE PODER',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-fuentes',
                            'icon_color' => 'red',
                        ],
                        [
                            'text' => 'POTENCIA',
                            'url' => '/potencia-fuentes',
                            'icon_color' => 'red',
                        ],
                    ]
                ],
                [
                    'text' => 'LECTOR CD-DVD',
                    'icon' => 'fas fa-fw fa-stop',
                    'submenu' => [
                        [
                            'text' => 'MARCA',
                            'url' => '/marca-lectorcds',
                            'icon_color' => 'red',
                        ],
                    ]
                ],

            ],
        ],
        [
            'text' => 'REQUERIMIENTO DE ASISTENCIA TÉCNICA',
            // 'classes' => 'text-blue text-bold',
            'url' => '/servicios',
            'icon' => 'fa fa-fw fa-cog',
            'can' => ['superadministrador','admin'],
        ],
        [
            'text' => 'MIS ASIGNACIONES DE SERVICIOS',
            // 'classes' => 'text-blue text-bold',
            'url' => '/asignaciones/asistencia',
            'icon' => 'fa fa-fw fa-cog',
            'can' => 'tecnico',
        ],
        // [
        //     'text' => 'REPORTES',
        //     'classes' => 'text-blue text-bold',
        //     'url' => '/reportes',
        //     'icon' => 'fa fa-fw fa-file',
        //     'can' => 'tecnico',
        //     'icon_color' => '',
        // ],
        [
            'text' => 'OTROS',
            // 'classes' => 'text-orange text-bold',
            'icon' => 'fas fa-file-alt',
            'can' => 'admin',
            'submenu' => [
                [
                    'text' => 'FUNCIONARIOS',
                    'url' => '/funcionarios',
                    'icon' => 'fas fas fa-house-user',
                    'can' => 'admin',
                ],
                [
                    'text' => 'TERMINOS Y CONDICIONES',
                    'url' => '/terminos/edit',
                    'icon' => 'fas fas fa-house-user',
                    'can' => 'admin',
                ],
                [
                    'text' => 'MODELOS DE CARTAS PARA SOLICITAR MANTENIMIENTO',
                    'url' => '/documentos',
                    'icon' => 'fas fas fa-house-user',
                    'can' => 'admin',
                ],
                // [
                //     'text' => 'ROLES',
                //     'url' => '/roles',
                //     'icon' => 'fas fas fa-house-user',
                //     'can' => 'admin',
                // ],
                [
                    'text' => 'RESPONSABLES',
                    'url' => '/responsables',
                    'icon' => 'fas fas fa-house-user',
                    'can' => 'admin',
                ],
                [
                    'text' => 'DEPENDENCIAS',
                    'icon' => 'fas fa-fw fa-stop',
                    'url' => '/dependencias',
                ],
                [
                    'text' => 'MANUAL DE USUARIO',
                    'icon' => 'fas fa-fw fa-stop',
                    'url' => '/manual-usuario',
                ],

            ],
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
