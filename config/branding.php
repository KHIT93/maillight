<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Service Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your service. This value is used when the
    | applications brands service in a notification or
    | any other location as required by the application or its packages.
    */
    'name' => env('BRANDING_NAME', 'MailLight'),
    /*
    |--------------------------------------------------------------------------
    | Service Logo
    |--------------------------------------------------------------------------
    |
    | This value is a path to the logo of your applcation.
    | This can either be a link to a external image or a path to a Local
    | file and used when the application needs to place the application's
    | logo in a notification or any other location as required
    | by the application or its packages.
    | If this is left empty, the application will display name of the service.
    */
    'logo' => '',
    /*
    |--------------------------------------------------------------------------
    | Support Information
    |--------------------------------------------------------------------------
    |
    | This set of values is used to inform users of the application where they
    | can get support  for any issues they might have. This information
    | will be displayed in the bottom of the application views and in
    | any other location as required by the application or its packages.
    */
    'support' => [
        /*
        |--------------------------------------------------------------------------
        | Support contact email
        |--------------------------------------------------------------------------
        |
        | This value is used to inform users about which email the support staff
        | can be contacted on, if they have any issues with the application
        | This value is used in notifications or any other locations as required
        | by the application or its packages.
        */
        'email' => 'support@example.com',
        /*
        |--------------------------------------------------------------------------
        | Support URL
        |--------------------------------------------------------------------------
        |
        | This value is used to inform users of the application, about where they
        | can find online help, such as an FAQ, Forum, Helpdesk etc.
        | This information will be displayed in notifications or any other
        | locations as required by the applications or it packages.
        */
        'url' => 'https://support.example.com',
        /*
        |--------------------------------------------------------------------------
        | Show Support Information
        |--------------------------------------------------------------------------
        |
        | This value defines if the support information should be shown to the users
        | of the application. This value is used when the
        | application needs to insert support information in a notification or
        | any other location as required by the application or its packages.
        */
        'show' => false
    ]
];
