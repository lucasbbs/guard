<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

class UpdateController
{
  public function __invoke()
  {
    $validation = Validation::validate(array_merge(
      [
        'name' => ['required', 'min:3', 'max:255'],
        'id' => ['required']
      ],
      session()->get('show') ? [
        'phone' => ['required'],
        'email' => ['required', 'email'],
        'address' => ['required']
      ] : []
    ), request()->post());

    if ($validation->fails()) {
      return redirect('/contacts?id=' . request()->post('id'));
    }

    Contact::update(
      request()->post('id'),
      request()->post('name'),
      request()->post('phone'),
      request()->post('email'),
      request()->post('address')
    );

    flash()->push('message', 'Record updated successfully!!');

    return redirect('/contacts?id=' . request()->post('id'));
  }
}
