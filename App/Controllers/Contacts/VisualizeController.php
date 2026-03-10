<?php

namespace App\Controllers\Contacts;

use Core\Validation;

class VisualizeController
{
  public function showAll()
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

  public function showSingle()
  {
    if (session()->get('show')) {
      return redirect('/contacts');
    }

    $input = request()->post();
    $contactId = $input['contact_id'] ?? $input['id'] ?? null;
    $password = $input['password'] ?? null;

    $visibleContacts = session()->get('visible_contacts') ?? [];
    $visibleContacts = is_array($visibleContacts) ? $visibleContacts : [];

    if (! is_string($password) || trim($password) === '') {
      if ($contactId !== null && ($visibleContacts[$contactId] ?? false) === true) {
        unset($visibleContacts[$contactId]);
        session()->set('visible_contacts', $visibleContacts);
        return redirect('/contacts');
      }

      $url = '/confirm';
      if ($contactId !== null && $contactId !== '') {
        $url .= '?contact_id=' . urlencode((string) $contactId);
      }

      return redirect($url);
    }

    $validation = Validation::validate([
      'password'   => ['required'],
      'contact_id' => ['required'],
    ], [
      'password' => $password,
      'contact_id' => $contactId,
    ]);

    if ($validation->fails()) {
      $url = '/confirm';
      if ($contactId !== null && $contactId !== '') {
        $url .= '?contact_id=' . urlencode((string) $contactId);
      }

      return redirect($url);
    }

    if (!password_verify($password, auth()->password)) {
      flash()->push('validations', [
        'password' => ['Password is incorrect!']
      ]);

      $url = '/confirm';
      if ($contactId !== null && $contactId !== '') {
        $url .= '?contact_id=' . urlencode((string) $contactId);
      }

      return redirect($url);
    }

    $visibleContacts[$contactId] = true;

    session()->set('visible_contacts', $visibleContacts);

    return redirect('/contacts');
  }

  public function hide()
  {
    session()->set('show', false);
    session()->forget('visible_contacts');
    return redirect('/contacts');
  }

  public function confirm()
  {
    $activeLetter = null;
    $contact_id = request()->get('contact_id');
    return view('contacts/confirm', compact('activeLetter', 'contact_id'));
  }
}
