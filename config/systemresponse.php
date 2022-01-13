<?php
return [
    'OPERATION_SUCCESS' => [
        'CODE' => 1000,
        'MESSAGE' => 'Process Successful'
    ],
    'OPERATION_FAILED' => [
        'CODE' => 999,
        'MESSAGE' => 'Process Failed'
    ],

    'BASIC_VALIDATION_FAILED' => [
        'CODE' => 1,
        'MESSAGE' => 'Request sanitization failed'
    ],

    'AUTH_USER_DELETE_FAILED' => [
        'CODE' => 2,
        'MESSAGE' => 'You can not delete yourself'
    ],

    'PARENT_USER_DELETE_FAILED' => [
        'CODE' => 3,
        'MESSAGE' => 'You can not delete yourself'
    ],

    'OBJECT_NOT_FOUND' => [
        'CODE' => 4,
        'MESSAGE' => 'Object not found'
    ],
];
