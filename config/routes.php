<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\Contacts;
use App\Controllers\RegisterController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
use Core\Route;


(new Route())

    ->get('/', IndexController::class, GuestMiddleware::class)
    ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
    ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
    ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
    ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)

    ->get('/logout', LogoutController::class, AuthMiddleware::class)
    ->get('/contacts', Contacts\IndexController::class, AuthMiddleware::class)
    ->get('/contacts/create', [Contacts\CreateController::class, 'index'], AuthMiddleware::class)
    ->post('/contacts/create', [Contacts\CreateController::class, 'store'], AuthMiddleware::class)

    ->put('/contacts', Contacts\UpdateController::class, AuthMiddleware::class)
    ->delete('/contacts', Contacts\DeleteController::class, AuthMiddleware::class)

    ->get('/confirm', [Contacts\VisualizeController::class, 'confirm'], AuthMiddleware::class)
    ->post('/show', [Contacts\VisualizeController::class, 'show'], AuthMiddleware::class)
    ->get('/hide', [Contacts\VisualizeController::class, 'hide'], AuthMiddleware::class)

    ->run();
