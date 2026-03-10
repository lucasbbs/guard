<?php

namespace App\Controllers;

use App\Models\User;
use Core\Database;
use Core\Validation;

class LoginController
{
  public function index()
  {
    return view('login', template: 'guest');
  }

  public function login()
  {
    $database = new Database(config('database'));


    $email = request()->post('email');

    $password = request()->post('password');

    $validation = Validation::validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ], data: request()->post());
    if ($validation->fails()) {
      return view('login', template: 'guest');
    }

    $user = $database->query(
      query: " select * from users where email = :email",
      class: User::class,
      params: compact('email')

    )->fetch();

    if (! ($user && password_verify(request()->post('password'), $user->password))) {

      flash()->push('validations', ['email' => ['User or password is incorrect!']]);
      return view('login', template: 'guest');
    } else {
      session()->set('auth', $user);

      flash()->push('message', "Welcome " . $user->name . "!");

      return redirect('/contacts');
    }
  }
}
