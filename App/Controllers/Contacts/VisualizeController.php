<?php

namespace App\Controllers\Contacts;

use Core\Validation;

class VisualizeController
{
  public function show()
  {
    $validation = Validation::validate([
      'password' => ['required']
    ], request()->post());

    if ($validation->fails()) {
      return view('contacts/confirm');
    }

    if (!password_verify(request()->post('password'), auth()->password)) {
      flash()->push('validations', ['password' => ['Password is incorrect!']]);

      return view('contacts/confirm');
    }

    session()->set('show', true);
    return redirect('/contacts');
  }

  public function hide()
  {
    session()->set('show', false);
    return redirect('/contacts');
  }

  public function confirm()
  {
    return view('contacts/confirm');
  }
}

