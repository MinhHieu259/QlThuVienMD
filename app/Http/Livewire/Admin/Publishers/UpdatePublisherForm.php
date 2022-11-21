<?php

namespace App\Http\Livewire\Admin\Publishers;

use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdatePublisherForm extends Component
{
    public $publisher;

    public $state = [];


    public function mount(Publisher $publisher) {
        $this->publisher = $publisher;
        $this->state = $publisher->toArray();
    }

    public function updatePublisher() {
        $validateData = Validator::make($this->state,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'The name field is required.',
            ])->validate();

        $this->publisher->update($validateData);

        $this->dispatchBrowserEvent('alert', ['message' => 'Publisher update successfully']);
    }


    public function render()
    {
        return view('livewire.admin.publishers.update-publisher-form');
    }
}
