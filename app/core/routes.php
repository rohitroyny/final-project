<?php

use app\controllers\UserController;
use app\controllers\MainController;
use app\controllers\EventController;

$routes = [
    // User management
    'login' => [
        'GET' => ['controller' => UserController::class, 'action' => 'viewLogin'],
        'POST' => ['controller' => UserController::class, 'action' => 'loginUser']
    ],
    'register' => [
        'GET' => ['controller' => UserController::class, 'action' => 'viewRegister'],
        'POST' => ['controller' => UserController::class, 'action' => 'saveUser']
    ],
    'users' => [
        'GET' => ['controller' => UserController::class, 'action' => 'getUsers'],
        'POST' => ['controller' => UserController::class, 'action' => 'saveUser']
    ],
    'view-users' => [
        'GET' => ['controller' => UserController::class, 'action' => 'viewUsers']
    ],

    // Event management
    'events' => [
        'GET' => ['controller' => EventController::class, 'action' => 'getEvents'],
        'POST' => ['controller' => EventController::class, 'action' => 'createEvent']
    ],
    'edit-event' => [
        'GET' => ['controller' => EventController::class, 'action' => 'viewEvent'],
        'POST' => ['controller' => EventController::class, 'action' => 'updateEvent']
    ],
    'delete-event' => [
        'POST' => ['controller' => EventController::class, 'action' => 'deleteEvent']
    ],

    // Main and Home Pages
    '' => [  // This handles the root directory access
        'GET' => ['controller' => MainController::class, 'action' => 'homepage']
    ],
    'home' => [
        'GET' => ['controller' => MainController::class, 'action' => 'homepage']
    ],
    '404' => [
        'GET' => ['controller' => MainController::class, 'action' => 'notFound']
    ],
];

