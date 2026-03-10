<?php

namespace App\Models;

use Core\Database;

class Contact
{
  public $id;
  public $user_id;
  public $name;
  public $phone;
  public $picture;
  public $email;
  public $address;
  public $locked;
  public $created_at;
  public $updated_at;

  public static function all($search = null, $letter = null)
  {
    $database = new Database(config('database'));

    $where = "user_id = :user_id";

    if ($search) {
      $where .= " AND name LIKE :search";
    }

    if ($letter) {
      $where .= " AND name LIKE :letter";
    }

    return $database->query(
      query: "SELECT * FROM contacts WHERE $where",
      class: self::class,
      params: array_merge(
        ['user_id' => auth()->id],
        $search ? ['search' => "%$search%"] : [],
        $letter ? ['letter' => "$letter%"] : []
      )
    )->fetchAll();
  }

  public static function update($id, $name, $phone = null, $email = null, $address = null)
  {
    $database = new Database(config('database'));

    $set = "name = :name";

    if ($phone !== null) {
      $set .= ", phone = :phone";
    }

    if ($email !== null) {
      $set .= ", email = :email";
    }

    if ($address !== null) {
      $set .= ", address = :address";
    }

    $database->query(
      query: "UPDATE contacts SET $set WHERE id = :id",
      params: array_merge(
        [
          'id' => $id,
          'name' => $name
        ],
        $phone !== null ? ['phone' => encrypt($phone)] : [],
        $email !== null ? ['email' => encrypt($email)] : [],
        $address !== null ? ['address' => encrypt($address)] : []
      )
    );
  }

  public static function create($data)
  {
    $database = new Database(config('database'));

    $data['phone'] = encrypt($data['phone']);
    $data['email'] = encrypt($data['email']);
    $data['address'] = encrypt($data['address']);

    $database->query(
      query: "insert into contacts (user_id, name, picture, phone, email, address, created_at, updated_at)
                values (
                    :user_id,
                    :name,
                    :picture,
                    :phone,
                    :email,
                    :address,
                    :created_at,
                    :updated_at
                )
            ",
      params: array_merge($data, [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ])
    );
  }

  public static function delete($id)
  {
    $database = new Database(config('database'));

    $database->query(
      query: "DELETE FROM contacts WHERE id = :id",
      params: [
        'id' => $id
      ]
    );
  }

  public static function isVisibleId($id): bool
  {
    if (session()->get('show')) {
      return true;
    }

    $visibleContacts = session()->get('visible_contacts') ?? [];
    if (! is_array($visibleContacts)) {
      return false;
    }

    if ($id === null || $id === '') {
      return false;
    }

    return ($visibleContacts[$id] ?? false) === true;
  }

  public function isVisible(): bool
  {
    return self::isVisibleId($this->id ?? null);
  }

  public function isLocked(): bool
  {
    return ! $this->isVisible();
  }

  public function phone()
  {
    if ($this->isVisible()) {
      return decrypt($this->phone);
    }

    return str_repeat('*****', 2);
  }

  public function email()
  {
    if ($this->isVisible()) {
      return decrypt($this->email);
    }

    return str_repeat('*****', 3);
  }

  public function address()
  {
    if ($this->isVisible()) {
      return decrypt($this->address);
    }

    return str_repeat('*****', 3);
  }
}
