<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Validation;

class UpdateController
{
  public function __invoke()
  {
    $validation = Validation::validate(array_merge(
      [
        'title' => ['required', 'min:3', 'max:255'],
        'id' => ['required']
      ],
      session()->get('show') ? ['note' => ['required']] : []
    ), request()->post());

    if ($validation->fails()) {
      return redirect('/notes?id=' . request()->post('id'));
    }

    Note::update(
      request()->post('id'),
      request()->post('title'),
      request()->post('note')
    );

    flash()->push('message', 'Record updated successfully!!');

    return redirect('/notes?id=' . request()->post('id'));
  }
}
