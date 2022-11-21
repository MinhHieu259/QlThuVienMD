<?php

namespace App\Http\Livewire\Admin\Authors;

use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAuthorForm extends Component
{
    public $state = [];

    public function createAuthor() {
        Validator::make($this->state,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'The name field is required.'
            ])->validate();

        $this->state['deleted'] = null;

        Author::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Author create successfully']);
    }

    public function render()
    {
        return view('livewire.admin.authors.create-author-form');
    }
}
