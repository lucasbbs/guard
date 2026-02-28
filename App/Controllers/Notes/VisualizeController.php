<?php

namespace App\Controllers\Notes;

use Core\Validation;

class VisualizeController
{
  public function show()
  {
    $validation = Validation::validate([
      'password' => ['required']
    ], request()->post());

    if ($validation->fails()) {
      return view('notes/confirm');
    }

    if (! (password_verify(request()->post('password'), auth()->password))) {
      flash()->push('validations', ['password' => ['Password is incorrect!']]);

      return view('/notes/confirm');
    }


    session()->set('show', true);
    return redirect('/notes');
  }

  public function hide()
  {
    session()->set('show', false);
    return redirect('/notes');
  }

  public function confirm()
  {
    return view('/notes/confirm');
  }
}
