<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListBookForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';



    protected $listeners = ['deleteConfirmed' => 'deleteBook'];

    public $bookIdBegingRemoved = null;

    public $selectedRows = [];

    public $selectPageRows = false;

    public $searchTerm = null;

    public $searchCategories = null;

    public $searchAuthor = null;


    public function confirmBookRemoval($book) {
        $this->bookIdBegingRemoved = $book;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteBook() {
//        $book = Book::findOrFail($this->bookIdBegingRemoved);
//        $book->delete();
        $book['deleted'] = Carbon::now()->toDateTimeString();
        Book::whereIn('_id', [$this->bookIdBegingRemoved])
            ->update(['deleted' => Carbon::now()->toDateTimeString()]);


        $this->dispatchBrowserEvent('deleted', ['message' => 'Book deleted success']);
    }

    public function updatedSelectPageRows($value) {
        if($value) {
            $this->selectedRows = $this->books->pluck('id')->map(function($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getBooksProperty() {
        $authorIds = array_map(fn($e) => $e['_id'], Author::select('_id')->where('deleted', null)->get()->toarray());
        $publisherIds = array_map(fn($e) => $e['_id'], Publisher::select('_id')->where('deleted', null)->get()->toarray());
        $categoryIds = array_map(fn($e) => $e['_id'], Category::select('_id')->where('deleted', null)->get()->toarray());
        return Book::query()
            ->where(function ($query) {
                $query->where('deleted', null);
                if($this->searchTerm != null) {
                    $query->where('name', 'like', '%'.$this->searchTerm.'%');
                }
                if($this->searchAuthor != null) {
                    $query->where('author_id', '=', $this->searchAuthor);
                }
                if(!empty($this->searchCategories)) {
                    $query->whereIn('category_id', $this->searchCategories);
                }
            })
            ->whereIn('author_id', $authorIds)
            ->whereIn('category_id', $categoryIds)
            ->whereIn('publisher_id', $publisherIds)
            ->latest()
            ->paginate(5);
    }

    public function deleteSelectedRows() {
        Book::whereIn('_id', $this->selectedRows)->update(['deleted' => Carbon::now()->toDateTimeString()]);
        $this->dispatchBrowserEvent('deleted', ['message' => 'All selected books got deleted. ']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }



    public function render()
    {
        $books = $this->books;
        $authors = Author::where('deleted', null)->get();
        $categories = Category::where('deleted', null)->get();
        return view('livewire.admin.books.list-book-form',
            compact('books', 'authors', 'categories')
        );
    }
}
