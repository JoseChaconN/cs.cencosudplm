<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Notification Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the default notification channel that is used
    | by the framework when a notification is being sent to a notifiable.
    | Supported: "database", "broadcast", "mail", "nexmo", "slack", "telegram"
    |
    */

    'default' => env('NOTIFICATION_CHANNEL', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Notification Channels
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the notification channels that will be used
    | to deliver notifications to other notifiable entities. The supported
    | channels include "database", "broadcast", "mail", "nexmo", "slack".
    |
    */

    'channels' => [

        'database' => [
            'driver' => 'database',
            'table' => 'notifications',
            'queue' => true,
            'expire' => 60,
        ],

        // Puedes agregar más canales según sea necesario

    ],

    // Resto de la configuración...

];
