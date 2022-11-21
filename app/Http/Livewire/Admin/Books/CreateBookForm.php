<?php

namespace App\Http\Livewire\Admin\Books;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class CreateBookForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;

    public $state = [];

    public $photo;

    public $searchCategory = null;


    public function createBook() {

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
            $validateData['image'] = $this->photo->store('/', 'images');
        }

        $validateData['deleted'] = null;

        Book::create($validateData);

        $this->dispatchBrowserEvent('alert', ['message' => 'Book create successfully'
        ]);
    }


    public function render()
    {
        $authors = Author::where('deleted', null)->get();
        $publishers = Publisher::where('deleted', null)->get();
        $categories = Category::where('deleted', null)->get();
        return view('livewire.admin.books.create-book-form', compact(
            'authors', 'publishers', 'categories'
        ));
    }
}
