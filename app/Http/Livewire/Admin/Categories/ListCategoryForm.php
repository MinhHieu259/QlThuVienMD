<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategoryForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;

    public $categoryIdBeginRemoved = null;

    protected $listeners = ['deleteConfirmed' => 'deleteCategory'];


    public function confirmCategoryRemoval($categoryId) {
        $this->categoryIdBeginRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteCategory() {
        Category::query()->whereIn('_id', [$this->categoryIdBeginRemoved])
            ->update(['deleted' => Carbon::now()->toDateTimeString()]);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Category deleted success']);
    }

    public function render()
    {
        $categories = Category::query()
            ->where('deleted', null)
            ->where(function ($query) {
                if(!empty($this->searchTerm)) {
                    $query->where('name', 'LIKE', '%' .$this->searchTerm. '%');
                }
            })
            ->latest()
            ->paginate(5);
        return view('livewire.admin.categories.list-category-form', compact('categories'));
    }
}
