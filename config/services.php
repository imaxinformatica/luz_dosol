<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'pagseguro' => [
        'pagseguro_email' => env('PAGSEGURO_EMAIL'),
        'pagseguro_token' => env('PAGSEGURO_TOKEN'),
    ],
    'correios' => [
        'cep_destino' => '04101300',
        'pagseguro_token' => env('PAGSEGURO_TOKEN'),
        'empresa' => env('CORREIOS_EMPRESA'),
        'senha' => env('CORREIOS_SENHA'),
    ],

];
