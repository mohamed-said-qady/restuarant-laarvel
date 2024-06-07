<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'manager' => [
            'employee' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'receptionist' => [
            'profile' => 'r,u', 
        ],
        'waiter' => [
            'profile' => 'r,u',
        ],
        'chef' => [
            'profile' => 'r,u',
        ],
        'chashir' => [
            'profile' => 'r,u',
        ],
        'customer' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
