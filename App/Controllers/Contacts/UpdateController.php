<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Validation;

class UpdateController
{
  public function __invoke()
  {
    $contactId = request()->post('id');
    $canEditSensitive = Contact::isVisibleId($contactId);

    $validation = Validation::validate(array_merge(
      [
        'name' => ['required', 'min:3', 'max:255'],
        'id' => ['required']
      ],
      $canEditSensitive ? [
        'phone' => ['required'],
        'email' => ['required', 'email'],
        'address' => ['required']
      ] : []
    ), request()->post());

    if ($validation->fails()) {
      return redirect('/contacts?id=' . $contactId);
    }

    $phone = $canEditSensitive ? request()->post('phone') : null;
    $email = $canEditSensitive ? request()->post('email') : null;
    $address = $canEditSensitive ? request()->post('address') : null;

    Contact::update(
      $contactId,
      request()->post('name'),
      $phone,
      $email,
      $address
    );

    flash()->push('message', 'Record updated successfully!!');

    return redirect('/contacts?id=' . $contactId);
  }
}
