<?php

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\Notes;
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
    ->get('/notes', Notes\IndexController::class, AuthMiddleware::class)
    ->get('/notes/create', [Notes\CreateController::class, 'index'], AuthMiddleware::class)
    ->post('/notes/create', [Notes\CreateController::class, 'store'], AuthMiddleware::class)

    ->put('/notes', Notes\UpdateController::class, AuthMiddleware::class)
    ->delete('/notes', Notes\DeleteController::class, AuthMiddleware::class)

    ->get('/confirm', [Notes\VisualizeController::class, 'confirm'], AuthMiddleware::class)
    ->post('/show', [Notes\VisualizeController::class, 'show'], AuthMiddleware::class)
    ->get('/hide', [Notes\VisualizeController::class, 'hide'], AuthMiddleware::class)

    ->run();
