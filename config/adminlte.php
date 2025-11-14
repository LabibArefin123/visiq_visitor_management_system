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

    'title' => 'VisiQ :: Visitor Management System ::',
    'title_prefix' => '',
    'title_postfix' => '',

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

    'logo' => '<span style="font-weight:700; color:#007bff; text-decoration:none;">Visi</span><span style="font-weight:700; color:#28a745; text-decoration:none;">Q</span>',
    'logo_img' => 'images/visiq.png',
    'logo_img_class' => 'brand-image img-circle elevation-4',
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

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'images/visiq.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

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

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'images/visiq.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 450,
            'height' => 400,
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
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

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
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

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
    'classes_sidebar' => 'sidebar-dark-purple elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav'  => 'navbar-purple navbar-light',
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
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
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
    'profile_url' => true,
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
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        [
            'text' => '',
            'icon' => 'fas fa-bell position-relative',
            'topnav_right' => true,
            'id' => 'notificationBell',
            'submenu' => [
                [
                    'text' => 'Pending Visitor List (0)',
                    'route' => 'pending_visitors.index',
                    'icon' => 'fas fa-user-clock',           // Left icon
                    'right_icon' => 'fas fa-circle-arrow-right', // Clean arrow-in-circle
                    'label_color' => 'info',
                ],
            ],
            'label' => null,
            'label_color' => 'danger',
        ],
        [
            'type' => 'navbar-item',
            'topnav_right' => true,
            'view' => 'partials.navbar.messages', // Use 'view' instead of 'text'
        ],


        // Sidebar items:

        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'Dashboard',
            'route' => 'dashboard',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'AI Chat',
            'url'  => 'ai_chat',
            'icon' => 'fas fa-fw fa-robot',
            'can'  => 'show-ai-chat',
        ],

        [
            'text'    => 'Organization Menu',
            'icon'    => 'fas fa-cogs',
            // 'route'    => 'organization_menu',
            'submenu' => [

                [
                    'text' => 'Organization List',
                    'route' => 'organizations.index',
                    'can' => 'organizations.index',
                    'active' => ['organizations*'],
                ],
            ],
        ],

        [
            'text'    => 'Department Menu',
            'icon'    => 'fas fa-book',
            // 'route'    => 'organization_menu',
            'submenu' => [

                [
                    'text' => 'Branch List',
                    'route' => 'branches.index',
                    'can' => 'branches.index',
                    'active' => ['branches*'],
                ],
                [
                    'text' => 'Division List',
                    'route' => 'divisions.index',
                    'can' => 'divisions.index',
                    'active' => ['divisions*'],
                ],
                [
                    'text' => 'Department List',
                    'route' => 'departments.index',
                    'can' => 'departments.index',
                    'active' => ['departments*'],
                ],
            ],
        ],

        [
            'text'    => 'Building Menu',
            'icon'    => 'fas fa-building',
            'submenu' => [
                [
                    'text' => 'Room List',
                    'route' => 'room_lists.index',
                    'can' => 'room_lists.index',
                    'active' => ['room_lists*'],
                ],
                [
                    'text' => 'Building List',
                    'route' => 'building_lists.index',
                    'can' => 'building_lists.index',
                    'active' => ['building_lists*'],
                ],
                [
                    'text' => 'Building Location',
                    'route' => 'building_locations.index',
                    'can' => 'building_locations.index',
                    'active' => ['building_locations*'],
                ],
                [
                    'text' => 'Sub Area List',
                    'route' => 'sub_areas.index',
                    'can' => 'sub_areas.index',
                    'active' => ['sub_areas*'],
                ],
                [
                    'text' => 'Area List',
                    'route' => 'areas.index',
                    'can' => 'areas.index',
                    'active' => ['areas*'],
                ],
            ],
        ],

        [
            'text'    => 'Visitor Menu',
            'icon'    => 'fas fa-fw fa-users',
            'submenu' => [
                [
                    'text' => 'Visitor List',
                    'route'  => 'visitors.index',
                    'can'  => 'visitors.index',
                    'active' => ['visitors*'],
                ],
                [
                    'text' => 'Visitor Company',
                    'route'  => 'visitor_companies.index',
                    'can'  => 'visitor_companies.index',
                    'active' => ['visitor_companies*'],
                ],
                [
                    'text' => 'Pending Visitors',
                    'route'  => 'pending_visitors.index',
                    'can'  => 'pending_visitors.index',
                    'active' => ['pending_visitors*'],
                ],
                [
                    'text' => 'Emergency Visitors',
                    'route'  => 'visitor_emergencys.index',
                    'can'  => 'visitor_emergencys.index',
                    'active' => ['visitor_emergencys*'],
                ],
                [
                    'text' => 'Probation Visitors',
                    'route'  => 'visitor_probations.index',
                    'can'  => 'visitor_probations.index',
                    'active' => ['visitor_probations*'],
                ],
                [
                    'text' => 'Blacklist Visitor',
                    'route'  => 'visitor_blacklists.index',
                    'can'  => 'visitor_blacklists.index',
                    'active' => ['visitor_blacklists*'],
                ],
                [
                    'text' => 'Visitor Group Member',
                    'route'  => 'visitor_group_members.index',
                    'can'  => 'visitor_group_members.index',
                    'active' => ['visitor_group_members*'],
                ],
            ],
        ],
        [
            'text' => 'Recruitment Menu',
            'icon' => 'fas fa-briefcase',
            'submenu' => [
                [
                    'text' => 'Visitor Job Applications',
                    'route'  => 'visitor_job_applications.index',
                    'can'  => 'visitor_job_applications.index',
                    'active' => ['visitor_job_applications*'],
                ],
            ],
        ],

        [
            'text'    => 'Employee Menu',
            'icon'    => 'fas fa-fw fa-users-cog',
            'submenu' => [
                [
                    'text' => 'Employee List',
                    'route'  => 'employees.index',
                    'can'  => 'employees.index',
                    'active' => ['employees*']
                ],
                [
                    'text' => 'Check-In Employees',
                    'route'  => 'employees.check_in_employee.index',
                    'can'  => 'employees.check_in_employee.index'
                ],
                [
                    'text' => 'Check-Out Employees',
                    'route'  => 'employees.check_out_employee.index',
                    'can'  => 'employees.check_out_employee.index'
                ],
                [
                    'text' => 'Attendance Tracking',
                    'route'  => 'employee_attendances.index',
                    'can'  => 'employee_attendances.index'
                ],


            ],
        ],
        [
            'text'    => 'Schedule Menu',
            'icon'    => 'fas fa-calendar-alt',
            'submenu' => [
                [
                    'text' => 'Meeting Schedule',
                    'route'  => 'meeting_schedules.index',
                    'can'  => 'meeting_schedules.index',
                    'active' => ['meeting_schedules*'],
                ],
                [
                    'text' => 'Interview Schedule',
                    'route'  => 'interview_schedules.index',
                    'can'  => 'interview_schedules.index',
                    'active' => ['interview_schedules*'],
                ],
                [
                    'text' => 'Office Schedule',
                    'route'  => 'office_schedules.index',
                    'can'  => 'office_schedules.index',
                    'active' => ['office_schedules*'],
                ],
                [
                    'text' => 'Shift Schedule',
                    'route'  => 'shift_schedules.index',
                    'can'  => 'shift_schedules.index',
                    'active' => ['shift_schedules*'],
                ],
                [
                    'text' => 'Visitor Host Schedule',
                    'route'  => 'visitor_host_schedules.index',
                    'can'  => 'visitor_host_schedules.index',
                    'active' => ['visitor_host_schedules*'],
                ],
                [
                    'text' => 'Visitor Group Schedule',
                    'route'  => 'visitor_group_schedules.index',
                    'can'  => 'visitor_group_schedules.index',
                    'active' => ['visitor_group_schedules*'],
                ],
                [
                    'text' => 'Guard Shift Schedule',
                    'route'  => 'shift_guard_schedules.index',
                    'can'  => 'shift_guard_schedules.index',
                    'active' => ['shift_guard_schedules*'],
                ],
                [
                    'text' => 'Weekend Schedule',
                    'route'  => 'weekend_schedules.index',
                    'can'  => 'weekend_schedules.index',
                    'active' => ['weekend_schedules*'],
                ],

            ],
        ],
        [
            'text'    => 'Report Menu',
            'icon'    => 'fas fa-fw fa-chart-pie',
            'submenu' => [
                [
                    'text' => 'Visitor Daily Reports',
                    'route'  => 'report.visitor.daily',
                    'can'  => 'report.visitor.daily'
                ],
                [
                    'text' => 'Visitor Monthly Reports',
                    'route'  => 'report.visitor.monthly',
                    'can'  => 'report.visitor.monthly'
                ],
                [
                    'text' => 'Visitor Yearly Reports',
                    'route'  => 'report.visitor.yearly',
                    'can'  => 'report.visitor.yearly'
                ],
                [
                    'text' => 'Employee Daily Reports',
                    'route'  => 'report.employee.daily',
                    'can'  => 'report.employee.daily'
                ],
                [
                    'text' => 'Employee Monthly Reports',
                    'route'  => 'report.employee.monthly',
                    'can'  => 'report.employee.monthly'
                ],
                [
                    'text' => 'Employee Yearly Reports',
                    'route'  => 'report.employee.yearly',
                    'can'  => 'report.employee.yearly'
                ],

            ],
            'classes' => 'nav-item-right-arrow', // Optional: Custom class for right-aligned arrow
        ],

        [
            'text'    => 'Security Menu',
            'icon'    => 'fas fa-user-shield',
            'submenu' => [
                // [
                //     'text' => 'Security Desk Logs',
                //     'icon' => 'fas fa-clipboard-list',
                //     'submenu' => [
                //         ['text' => 'Check-In Log', 'url' => '#'],
                //         ['text' => 'Check-Out Log', 'url' => '#'],
                //         ['text' => 'Gate Pass Verification', 'url' => '#'],
                //     ],
                // ],
                [
                    'text' => 'Access Point Management',
                    'icon' => 'fas fa-arrow-circle-right',
                    'submenu' => [
                        [
                            'text' => 'Access Points',
                            'route' => 'access_points.index',
                            'can' => 'access_points.index',
                            'active' => ['access_points*'],
                        ],
                        [
                            'text' => 'Access Point Guards',
                            'route' => 'access_point_guards.index',
                            'can' => 'access_point_guards.index',
                            'active' => ['access_point_guards*'],
                        ],
                        [
                            'text' => 'Access History Logs',
                            'route' => 'access_point_guards.activity_log',
                            'can' => 'access_point_guards.activity_log'
                        ],
                    ],
                ],
                [
                    'text' => 'ID Card Management',
                    'icon' => 'fas fa-arrow-circle-right',
                    'submenu' => [
                        [
                            'text' => 'Visitor ID Card List',
                            'route' => 'visitor_id_cards.index',
                            'can' => 'visitor_id_cards.index',
                            'active' => ['visitor_id_cards*'],
                        ],
                        [
                            'text' => 'ID Card List',
                            'route' => 'id_cards.index',
                            'can' => 'id_cards.index',
                            'active' => ['id_cards*'],
                        ],
                    ],
                ],
                [
                    'text' => 'Guard Management',
                    'icon' => 'fas fa-arrow-circle-right',
                    'submenu' => [
                        [
                            'text' => 'Guard List',
                            'route' => 'guards.index',
                            'can' => 'guards.index',
                            'active' => ['guards*'],
                        ],
                        [
                            'text' => 'Guard Activity Log',
                            'route' => 'guards.activity_log',
                            'can' => 'guards.activity_log',
                        ],
                    ],
                ],
                [
                    'text' => 'Security Alerts & Incidents',
                    'icon' => 'fas fa-bell',
                    'submenu' => [
                        [
                            'text' => 'Overstay Alerts',
                            'route' => 'overstay_alerts.index',
                            'can' => 'overstay_alerts.index',
                            'active' => ['overstay_alerts*'],
                        ],

                        [
                            'text' => 'Emergency Incidents',
                            'route' => 'emergency_incidents.index',
                            'can' => 'emergency_incidents.index',
                            'active' => ['emergency_incidents*'],
                        ],

                        [
                            'text' => 'Medical Emergencies',
                            'route' => 'medical_emergencies.index',
                            'can' => 'medical_emergencies.index',
                            'active' => ['medical_emergencies*'],
                        ],

                        [
                            'text' => 'Evacuation Plan',
                            'route' => 'evacuation_plans.index',
                            'can' => 'evacuation_plans.index',
                            'active' => ['evacuation_plans*'],
                        ],

                        [
                            'text' => 'Blacklist Monitor',
                            'route' => 'visitor_blacklists.activity_log',
                            'can' => 'visitor_blacklists.activity_log',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text' => 'Facility Center',
            'icon' => 'fas fa-cogs',
            'submenu' => [
                [
                    'text' => 'Seat Allocation',
                    'route' => 'seat_allocations.index',
                    'can' => 'seat_allocations.index',
                    'active' => ['seat_allocations*'],
                ],
                [
                    'text' => 'Meeting Reservation',
                    'url' => '#'
                ],
            ],
        ],
        [
            'text' => 'Assets & Equipment',
            'icon' => 'fas fa-boxes',
            'submenu' => [
                // ['text' => 'Asset Inventory', 'url' => 'assets'],
                // ['text' => 'Equipment Maintenance', 'url' => 'equipment_maintenance'],
                [
                    'text' => 'Lost & Found',
                    'route' => 'lost_and_founds.index',
                    'can' => 'lost_and_founds.index',
                    'active' => ['lost_and_founds*'],
                ],
            ],
        ],

        [
            'text' => 'Communication',
            'icon' => 'fas fa-comments',
            'submenu' => [
                [
                    'text' => 'Announcements',
                    'route' => 'announcements.index',
                    'can' => 'announcements.index',
                    'active' => ['announcements*'],
                ],
                [
                    'text' => 'Visitor Feedback',
                    'route' => 'visitors.feedback',
                    'can' => 'visitors.feedback',
                ],
            ],
        ],

        [
            'text' => 'Parking Management',
            'icon' => 'fas fa-car',
            'submenu' => [
                // ['text' => 'Vehicle Log', 'url' => 'vehicle_logs'],
                [
                    'text' => 'Parking Allotment',
                    'route' => 'parking_allotments.index',
                    'can' => 'parking_allotments.index',
                    'active' => ['parking_allotments*'],
                ],
                [
                    'text' => 'Parking Permit',
                    'route' => 'parking_permits.index',
                    'can' => 'parking_permits.index',
                    'active' => ['parking_permits*'],
                ],
                [
                    'text' => 'Parking List',
                    'route' => 'parking_lists.index',
                    'can' => 'parking_lists.index',
                    'active' => ['parking_lists*'],
                ],
                [
                    'text' => 'Parking Location',
                    'route' => 'parking_locations.index',
                    'can' => 'parking_locations.index',
                    'active' => ['parking_locations*'],
                ],
                // [
                //     'text' => 'Parking Permits',
                //     'url' => 'parking_permits'
                // ],
            ],
        ],
        [
            'text'    => 'Setting Menu',
            'icon'    => 'fas fa-cogs',
            // 'route'    => 'menu.setting',
            // 'can'   => 'menu.setting',
            'submenu' => [
                [
                    'text' => 'User Category List',
                    'route' => 'user_categories.index',
                    'can' => 'user_categories.index',
                    'active' => ['user_categories*'],
                ],
                [
                    'text' => 'Role List',
                    'route' => 'roles.index',
                    'can' => 'roles.index',
                    'active' => ['roles*'],
                ],
                [
                    'text' => 'Permission List',
                    'route' => 'permissions.index',
                    'can' => 'permissions.index',
                    'active' => ['permissions*'],
                ],
                [
                    'text' => 'System Users',
                    'route' => 'system_users.index',
                    'can' => 'system_users.index',
                    'active' => ['system_users*'],
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
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
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
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
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
];
