<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "sendmail", "mailgun", "mandrill", "ses",
    |            "sparkpost", "log", "array"
    |
    */

    'driver' => env('MAIL_DRIVER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Address
    |--------------------------------------------------------------------------
    |
    | Here you may provide the host address of the SMTP server used by your
    | applications. A default option is provided that is compatible with
    | the Mailgun mail service which will provide reliable deliveries.
    |
    */

    'host' => env('MAIL_HOST', 'localhost'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Port
    |--------------------------------------------------------------------------
    |
    | This is the SMTP port used by your application to deliver e-mails to
    | users of the application. Like the host we have set this value to
    | stay compatible with the Mailgun e-mail application by default.
    |
    */

    'port' => env('MAIL_PORT', 587),

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | E-Mail Encryption Protocol
    |--------------------------------------------------------------------------
    |
    | Here you may specify the encryption protocol that should be used when
    | the application send e-mail messages. A sensible default using the
    | transport layer security protocol should provide great security.
    |
    */

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Server Username
    |--------------------------------------------------------------------------
    |
    | If your SMTP server requires a username for authentication, you should
    | set it here. This will get used to authenticate with your server on
    | connection. You may also set the "password" value below this one.
    |
    */

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    'mailscanner' => [
        /*
        |--------------------------------------------------------------------------
        | MailScanner Configuration Directory
        |--------------------------------------------------------------------------
        |
        | This is the path on local server where the MailScanner application
        | configuration is located.
        |
        */
        'config_dir' => env('MAILSCANNER_CONFIG_DIR', '/etc/MailScanner/'),
        /*
        |--------------------------------------------------------------------------
        | MailScanner Libraries Directory
        |--------------------------------------------------------------------------
        |
        | This is the path on local server where the MailScanner application
        | libraries located.
        |
        */
        'lib_dir' => env('MAILSCANNER_LIB_DIR', '/usr/share/MailScanner/'),
        /*
        |--------------------------------------------------------------------------
        | MailScanner Executable
        |--------------------------------------------------------------------------
        |
        | This is the path to the MailScanner executable file, which is used
        | to perform various actions on the filtered email.
        |
        */
        'executable' => env('MAILSCANNER_EXECUTABLE', '/usr/sbin/MailScanner'),
    ],
    'spamassassin' => [
        /*
        |--------------------------------------------------------------------------
        | Spam Assassin Executables
        |--------------------------------------------------------------------------
        |
        | This is the path to the folder, where all the executable
        | files/applications for Spam Assassin are located
        | These are used to handle filtering of Spam messages.
        |
        */
        'executable' => env('SPAMASSASSIN_DIR', '/usr/bin/'),
        /*
        |--------------------------------------------------------------------------
        | Spam Assassin Rules Directory
        |--------------------------------------------------------------------------
        |
        | This is the location of the Spam Assassin Rules that are applied to
        | filtered email.
        |
        */
        'rules_dir' => env('SPAMASSASSIN_RULES_DIR', '/usr/share/spamassassin/'),
        /*
        |--------------------------------------------------------------------------
        | Spam Assassin Preferences File
        |--------------------------------------------------------------------------
        |
        | This is the path to the file where MailScanner keeps all
        | of the preferences defined for Spam Assasin
        |
        */
        'preferences' => env('SPAMASSASSIN_PREFS', 'spam.assassin.prefs.conf')
    ],
    /*
    |--------------------------------------------------------------------------
    | Mail Log Location
    |--------------------------------------------------------------------------
    |
    | This is the location of the mail log on the local system
    | This is used to define which file is used to store information about
    | incoming and outgoing messages.
    |
    */
    'log' => env('MAILLOG', '/var/log/maillog'),

];
