<?php

namespace App\Http\Livewire\Admin\Authors;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;
use Livewire\WithPagination;

class ListAuthorForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;


    public $authorIdBeginRemoved = null;

    protected $listeners = ['deleteConfirmed' => 'deleteAuthor'];


    public function confirmAuthorRemoval($authorId) {
        $this->authorIdBeginRemoved = $authorId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteAuthor() {
        Author::query()->whereIn('_id', [$this->authorIdBeginRemoved])
            ->update(['deleted' => Carbon::now()->toDateTimeString()]);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Author deleted success']);
    }

    public function render()
    {
        $authors = Author::query()
            ->where('deleted', null)
            ->where(function ($query) {
                if(!empty($this->searchTerm)) {
                    $query->where('name', 'LIKE', '%' .$this->searchTerm. '%');
                }
            })
            ->latest()
            ->paginate(5);
        return view('livewire.admin.authors.list-author-form', compact('authors'));
    }
}
