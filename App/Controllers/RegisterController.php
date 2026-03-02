<?php

namespace App\Controllers;

use Core\Database;
use Core\Validation;

class RegisterController
{
  public function index()
  {
    return view('register', template: 'guest');
  }

  public function register()
  {
    $database = new Database(config('database'));

    $validations = Validation::validate([
      'name' => ['required'],
      'email' => ['required', 'email', 'unique:users'],
      'password' => ['required', 'length:8:30', 'strong', 'matches:password'],
    ], data: request()->post());

    if ($validations->fails()) {
      return view('register', template: 'guest');
    }

    $database->query(query: 'insert into users (name, email, password) values (:name, :email, :password)', params: [
      'name' => request()->post('name'),
      'email' => request()->post('email'),
      'password' => password_hash(request()->post('password'), PASSWORD_DEFAULT)
    ]);
    flash()->push('message', 'Account created successfully, please login.');
    return redirect('/login');
  }
}
