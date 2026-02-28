<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Validation;

class DeleteController
{
  public function __invoke()
  {
    $validation = Validation::validate([
      'id' => ['required']
    ], request()->post());

    if ($validation->fails()) {
      return redirect('/notes?id=' . request()->post('id'));
    }

    Note::delete(
      request()->post('id')
    );

    flash()->push('message', 'Record deleted successfully!!');

    return redirect('/notes');
  }
}
