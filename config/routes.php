<?php

use App\Controllers\IndexController;
use Core\Route;


(new Route())
    ->get('/', IndexController::class)

    ->run();
