<?php

namespace App\Controllers\Notes;

use App\Models\Note;

class IndexController
{
  public function __invoke()
  {

    $search = request()->get('search');

    $notes = Note::all($search);


    $selectedNote = $this->getSelectedNote($notes);

    if (!$selectedNote) {
      return view('notes/not-found');
    }
    return view('notes/index', [
      'notes' => $notes,
      'selectedNote' => $selectedNote,
    ]);
  }

  private function getSelectedNote($notes)
  {
    $id = request()->get('id', (sizeof($notes) > 0 ? $notes[0]->id : null));
    $filter = array_filter($notes, fn($n) => $n->id == $id);
    return array_pop($filter);
  }
}
