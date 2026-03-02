<?php

namespace App\Controllers\Contacts;

use App\Models\Contact;
use Core\Upload;
use Core\Validation;

class CreateController
{
  private function redirectBack(string $fallback = '/contacts')
  {
    $referer = $_SERVER['HTTP_REFERER'] ?? '';

    if (!is_string($referer) || $referer === '') {
      return redirect($fallback);
    }

    $path = parse_url($referer, PHP_URL_PATH);
    $query = parse_url($referer, PHP_URL_QUERY);
    if (!is_string($path) || $path === '') {
      return redirect($fallback);
    }

    $target = $path . (is_string($query) && $query !== '' ? "?$query" : '');

    return redirect($target);
  }

  public function index()
  {
    return view('contacts/create');
  }

  public function store()
  {
    $picture = request()->file('picture');
    $data = array_merge(request()->post(), [
      'picture' => $picture,
    ]);

    $validation = Validation::validate([
      'name' => ['required', 'min:3', 'max:255'],
      'picture' => ['image'],
      'phone' => ['required'],
      'email' => ['required', 'email'],
      'address' => ['required']
    ], data: $data);

    if ($validation->fails('create')) {
      return $this->redirectBack();
    }

    $picturePath = Upload::storeImage($picture);
    if ($picturePath === false) {
      flash()->push('validations_create', ['picture' => ['Unable to save the uploaded picture.']]);
      return $this->redirectBack();
    }
    $pictureFilename = is_string($picturePath) ? basename($picturePath) : null;

    Contact::create([
      'user_id' => auth()->id,
      'name' => request()->post('name'),
      'picture' => $pictureFilename ?? null,
      'phone' => request()->post('phone'),
      'email' => request()->post('email'),
      'address' => request()->post('address')
    ]);
    flash()->push('message', 'Contact created successfully!');
    return redirect('/contacts');
  }
}
