<?php

namespace App\Http\Livewire\Admin\BorrowBook;

use App\Models\Book;
use App\Models\BorrowBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditBorrowBook extends Component
{
    public $state = [];
    public $borrow;

    public function mount(BorrowBook $borrow)
    {
        $this->state = $borrow->toArray();
        $this->borrow = $borrow;
    }

    public function updateBorrow()
    {
        $validateData = Validator::make($this->state,
            [
                'quantity' => 'required',
                'borrowing_day' => 'required',
                'borrowing_time' => 'required',
                'book_id' => 'required',
                'return_day' => 'required',
                'return_time' => 'required',
                'note' => 'nullable',
                'status' => 'required|in:BORROWING,RETURN',
            ],
            [
                'quantity.required' => 'The quantity field is required !!!',
                'borrowing_day.required' => 'The Borrow Day field is required !!!',
                'borrowing_time.required' => 'The Borrow time field is required !!!',
                'return_day.required' => 'The Return Day field is required !!!',
                'return_time.required' => 'The Return time field is required !!!',
                'book_id.required' => 'The book field is required !!!',
                'status.required' => 'The status field is required !!!'
            ])->validate();

        $this->borrow->update($validateData);
        $this->dispatchBrowserEvent('alert', ['message' => 'Borrow update successfully']);
    }

    public function render()
    {
        $books = Book::where('deleted', null)->get();
        return view('livewire.admin.borrow-book.edit-borrow-book', [
            'books' => $books
        ]);
    }
}
