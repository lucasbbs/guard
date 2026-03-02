<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../Core/functions.php";

spl_autoload_register(function ($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  require base_path("{$class}.php");
});


session_start();

require base_path("config/routes.php");
