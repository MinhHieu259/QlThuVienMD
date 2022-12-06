<?php

namespace App\Http\Livewire\Admin\BorrowBook;

use App\Models\Book;
use App\Models\BorrowBook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AddBorrowBook extends Component
{
    public $state = [
        'status' => 'BORROWING',
        'return_day' => '',
        'return_time' => ''
    ];

    public function addBorrow(){
        $validateData = Validator::make($this->state,
            [
                'quantity' => 'required',
                'borrowing_day' => 'required',
                'borrowing_time' => 'required',
                'book_id' => 'required',
                'user_id' => 'required',
                'note' => 'nullable',
                'status' => 'required|in:BORROWING,RETURN',
            ],
            [
                'quantity.required' => 'The quantity field is required !!!',
                'borrowing_day.required' => 'The Borrow Day field is required !!!',
                'borrowing_time.required' => 'The Borrow time field is required !!!',
                'book_id.required' => 'The book field is required !!!',
                'user_id.required' => 'The user field is required !!!',
                'status.required' => 'The status field is required !!!'
            ])->validate();

        $validateData['return_day'] = null;
        $validateData['return_time'] = null;

        BorrowBook::create($validateData);
        $this->dispatchBrowserEvent('alert', ['message' => 'Borrow add successfully']);
    }

    public function render()
    {
        $books = Book::where('deleted', null)->get();
        $users = User::where('deleted', null)->get();
        return view('livewire.admin.borrow-book.add-borrow-book', [
            'books' => $books,
            'users' => $users
        ]);
    }
}
