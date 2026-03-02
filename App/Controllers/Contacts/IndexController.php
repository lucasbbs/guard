<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;

class IndexController
{
  public function __invoke()
  {

    $search = request()->get('search');
    $activeLetter = $this->normalizeLetter(request()->get('letter'));

    $allContacts = Contact::all($search);
    $availableLetters = $this->getAvailableLetters($allContacts);

    $contacts = $activeLetter ? Contact::all($search, $activeLetter) : $allContacts;


    // $selectedContact = $this->getSelectedContact($contacts);

    // if (!$selectedContact) {
    //   return view('contacts/not-found', [
    //     'activeLetter' => $activeLetter,
    //     'availableLetters' => $availableLetters,
    //     'baseUrl' => '/contacts',
    //     'search' => $search,
    //   ]);
    // }
    return view('contacts/index', [
      'contacts' => $contacts,
      // 'selectedContact' => $selectedContact,
      'activeLetter' => $activeLetter,
      'availableLetters' => $availableLetters,
      'baseUrl' => '/contacts',
      'search' => $search,
    ]);
  }

  private function getSelectedContact($contacts)
  {
    $id = request()->get('id', (sizeof($contacts) > 0 ? $contacts[0]->id : null));
    $filter = array_filter($contacts, fn($n) => $n->id == $id);
    return array_pop($filter);
  }

  private function normalizeLetter($letter)
  {
    if (!is_string($letter) || !preg_match('/^[a-z]$/i', $letter)) {
      return null;
    }

    return strtoupper($letter);
  }

  private function getAvailableLetters($contacts)
  {
    $letters = [];

    if (!is_iterable($contacts)) {
      return [];
    }

    foreach ($contacts as $contact) {
      $name = trim((string)($contact->name ?? ''));
      if ($name === '') {
        continue;
      }

      $first = function_exists('mb_substr')
        ? mb_substr($name, 0, 1, 'UTF-8')
        : substr($name, 0, 1);

      $first = strtoupper($first);

      if (preg_match('/^[A-Z]$/', $first)) {
        $letters[$first] = true;
      }
    }

    return array_keys($letters);
  }
}
