<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Default locale
    |---------------------------------------------------------------------------
    |
    | If not set, it will use the Laravel app locale.
    | For example: en_US, en_GB, sv_SE, etc.
    |
    */
    'default_locale' => env('MONEY_DEFAULT_LOCALE', 'es_AR'),

    /*
    |---------------------------------------------------------------------------
    | Default currency
    |---------------------------------------------------------------------------
    |
    | The currency ISO code to use if not set on the field.
    | For example: USD, EUR, SEK, etc.
    |
    */
    'default_currency' => env('MONEY_DEFAULT_CURRENCY', 'USD'),

    /*
    |---------------------------------------------------------------------------
    | Default currency
    |---------------------------------------------------------------------------
    |
    | The currency code to use if not set on the field.
    |
    */
    'use_input_mask' => env('MONEY_USE_INPUT_MASK', true),

    /*
    |---------------------------------------------------------------------------
    | International currency symbol
    |---------------------------------------------------------------------------
    |
    | Use international currency symbols. For example: USD, EUR, SEK instead of $, €, kr etc.
    |
    */
    'intl_currency_symbol' => env('MONEY_INTL_CURRENCY_SYMBOL', false),


    /*
    |---------------------------------------------------------------------------
    | Currency symbol placement
    |---------------------------------------------------------------------------
    |
    | Where the dunit should be on form fields. Options are 'before' (prefix), 'after' (suffix) or 'none'.
    |
    */
    'form_currency_symbol_placement' => env('MONEY_UNIT_PLACEMENT', 'before'),

];
