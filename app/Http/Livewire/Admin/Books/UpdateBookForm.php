<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UpdateBookForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;

    public $state = [];

    public $book;

    public $photo;

    public $image_url = '';

    public function mount(Book $book) {
        $this->state = $book->toArray();
        $this->book = $book;
    }

    public function updateBook() {
        $validateData = Validator::make($this->state,
            [
                'category_id' => 'required',
                'publisher_id' => 'required',
                'author_id' => 'required',
                'name' => 'required',
                'year_publisher' => 'required',
                'note' => 'nullable',
            ],
            [
                'name.required' => 'The name field is required.',
                'year_publisher.required' => 'The year publisher field is required.',
                'category_id.required' => 'The year category  field is required.',
                'publisher_id.required' => 'The year publisher field is required.',
                'author_id.required' => 'The year author field is required.',
            ])->validate();

        if($this->photo) {
            Storage::disk('images')->delete($this->book->image);
            $validateData['image'] = $this->photo->store('/', 'images');
        }

        $this->book->update($validateData);

        $this->dispatchBrowserEvent('alert', ['message' => 'Book update successfully'
        ]);
    }

    public function render()
    {
        $authors = Author::where('deleted', null)->get();
        $publishers = Publisher::where('deleted', null)->get();
        $categories = Category::where('deleted', null)->get();
        return view('livewire.admin.books.update-book-form',
            compact('authors', 'publishers', 'categories')
        );
    }
}
