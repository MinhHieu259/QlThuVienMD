<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UpdateCategoryForm extends Component
{
    public $category;

    public $state = [];


    public function mount(Category $category) {
        $this->category = $category;
        $this->state = $category->toArray();
    }

    public function updateCategory() {
        $validateData = Validator::make($this->state,
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'The name field is required.',
            ])->validate();

        $this->category->update($validateData);

        $this->dispatchBrowserEvent('alert', ['message' => 'Category update successfully']);
    }

    public function render()
    {
        return view('livewire.admin.categories.update-category-form');
    }
}
