<?php

namespace App\Http\Livewire\Admin\Authors;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateAuthorForm extends Component
{
    public $author;

    public $state = [];


    public function mount(Author $author) {
        $this->author = $author;
        $this->state = $author->toArray();
    }

    public function updateAuthor() {
        $validateData = Validator::make($this->state,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'The name field is required.',
            ])->validate();

        $this->author->update($validateData);

        $this->dispatchBrowserEvent('alert', ['message' => 'Author update successfully']);
    }

    public function render()
    {
        return view('livewire.admin.authors.update-author-form');
    }
}
