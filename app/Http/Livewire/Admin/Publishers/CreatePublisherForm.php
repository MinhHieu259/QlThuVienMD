<?php

namespace App\Http\Livewire\Admin\Publishers;

use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreatePublisherForm extends Component
{
    public $state = [];

    public function createPublisher() {
        Validator::make($this->state,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'The name field is required.'
            ])->validate();

        Publisher::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Publisher create successfully']);
    }
    public function render()
    {
        return view('livewire.admin.publishers.create-publisher-form');
    }
}
