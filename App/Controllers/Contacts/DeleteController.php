<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

class DeleteController
{
  public function __invoke()
  {
    $validation = Validation::validate([
      'id' => ['required']
    ], request()->post());

    if ($validation->fails()) {
      return redirect('/contacts?id=' . request()->post('id'));
    }

    Contact::delete(
      request()->post('id')
    );

    flash()->push('message', 'Record deleted successfully!!');

    return redirect('/contacts');
  }
}
