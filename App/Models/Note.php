<?php

namespace App\Models;

use Core\Database;

class Note
{
  public $id;
  public $user_id;
  public $title;
  public $note;
  public $created_at;
  public $updated_at;

  public static function all($search = null)
  {
    $database = new Database(config('database'));

    return $database->query(
      query: "SELECT * FROM notes WHERE user_id = :user_id" .
        (
          $search ? " AND title LIKE :search " : ""
        ),
      class: self::class,
      params: array_merge(
        ['user_id' => auth()->id],
        $search ? ['search' => "%$search%"] : []
      )
    )->fetchAll();
  }

  public static function update($id, $title, $note)
  {
    $database = new Database(config('database'));

    $set = "title = :title";

    if ($note) {
      $set .= ", note = :note";
    }



    $database->query(
      query: "UPDATE notes SET $set WHERE id = :id",
      params: array_merge(
        [
          'id' => $id,
          'title' => $title
        ],
        $note ? ['note' => encrypt($note)] : []
      )
    );
  }

  public static function create($data)
  {
    $database = new Database(config('database'));

    $data['note'] = encrypt($data['note']);

    $database->query(
      query: "insert into notes (user_id, title, note, created_at, updated_at)
                values (
                    :user_id,
                    :title,
                    :note,
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
      query: "DELETE FROM notes WHERE id = :id",
      params: [
        'id' => $id
      ]
    );
  }

  public function note()
  {
    if (session()->get('show')) {
      return decrypt($this->note);
    }

    return str_repeat('***** ', 20);
  }
}
