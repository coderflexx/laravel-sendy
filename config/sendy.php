<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sendy Installation URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to connect to your Sendy installation. It should
    | point to the root of your Sendy installation. For example:
    | https://your-sendy-installation.com
    */
    'sendy_installation_url' => env('SENDY_INSTALLATION_URL', 'https://your-sendy-installation.com'),

    /*
    |--------------------------------------------------------------------------
    | Sendy API Key
    |--------------------------------------------------------------------------
    |
    | This key is used to authenticate your application with the Sendy
    | installation. You can find your API key in the Sendy settings.
    | Make sure to keep this key secure and do not share it with anyone.
    | It is recommended to use environment variables to store sensitive
    | information like API keys. You can set the SENDY_API_KEY
    */
    'sendy_api_key' => env('SENDY_API_KEY', 'your-sendy-api-key'),
];
