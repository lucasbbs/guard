<?php

namespace App\Controllers;

use Core\Database;
use Core\Validation;

class SettingsController
{
  public function index()
  {
    $activeLetter = null;
    return view('settings', compact('activeLetter'));
  }

  public function settings()
  {
    $database = new Database(config('database'));

    $validation = Validation::validate(array_merge(
      [
        'password' => ['required', 'length:8:30', 'strong', 'matches:password'],
      ],
    ), request()->post());

    if ($validation->fails()) {
      return redirect('/settings');
    }



    $database->query(
      query: 'update users set password = :password where id = :id',
      params: [
        'password' => password_hash(request()->post('password'), PASSWORD_DEFAULT),
        'id' => auth()->id
      ]
    );

    flash()->push('message', 'Password updated successfully!!');

    return redirect('/contacts');
  }
}
