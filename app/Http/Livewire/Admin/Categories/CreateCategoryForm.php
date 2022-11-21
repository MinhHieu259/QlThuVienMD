<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCategoryForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function createCategory() {
        Validator::make($this->state,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'The name field is required.'
            ])->validate();

        Category::create($this->state);

        $this->dispatchBrowserEvent('alert', ['message' => 'Category create successfully']);
    }


    public function render()
    {
        return view('livewire.admin.categories.create-category-form');
    }
}
