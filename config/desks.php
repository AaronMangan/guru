<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Desks Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the configuration for desks. This includes the
    | number of desks to seed into the database and any other desk related
    | configuration that may be needed in the future.
    |
    */
    'number_of_desks' => env('NUMBER_OF_DESKS', 22),

    /*
    |--------------------------------------------------------------------------
    | Desk Numbering Prefix
    |--------------------------------------------------------------------------
    |
    | Add a prefix to the desk numbers. This can be useful if you want to have
    | a consistent naming convention for your desks. For example, if you set
    | the prefix to "Desk-", the desks will be named "Desk-1", "Desk-2", etc.
    |
    */
    'numbering_prefix' => env('DESK_NUMBERING_PREFIX', 'D'),
];