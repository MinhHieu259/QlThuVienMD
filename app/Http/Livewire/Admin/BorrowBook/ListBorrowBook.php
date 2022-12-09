<?php

namespace App\Http\Livewire\Admin\BorrowBook;

use App\Models\BorrowBook;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListBorrowBook extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedRows = [];

    public $searchTerm = null;

    public $searchUserName = null;

    public $status = null;

    public $selectPageRows = false;

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->borrows->pluck('id')->map(function ($id) {
                return (string)$id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getBorrowsProperty()
    {
        return BorrowBook::query()
            ->where(function ($query) {
                $query->select("*");
                if($this->searchTerm != null) {
                    $query->where('borrowing_day', 'like', '%'.$this->searchTerm.'%');
                }
                if($this->status != null) {
                    $query->where('status', $this->status);
                }
                if($this->searchUserName != null) {
                    $query->whereIn('user_id', $this->searchUserName);
                }
            })
            ->paginate(5);
//        $query = '';
//        if ($this->status == null && $this->searchTerm == null){
//            $query = BorrowBook::paginate(5);
//        }
//        if($this->status != null) {
//            $query = BorrowBook::where('status', $this->status)->paginate(5);
//        }
//        if($this->searchTerm != null) {
//            $query = DB::table('borrow_books')->join('users','borrow_books.user_id', '=', 'users._id')->where('users.name', 'like', '%'.$this->searchTerm.'%')->paginate(5);
//        }
//        return $query;
    }

    public function markAllAsBorrowing()
    {
        BorrowBook::whereIn('_id', $this->selectedRows)->update(['status' => 'BORROWING']);
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected borrow got updated borrow']);
        $this->reset(['selectedRows', 'selectPageRows']);
    }

    public function markAllAsReturned()
    {
        BorrowBook::whereIn('_id', $this->selectedRows)->update(['status' => 'RETURN']);
        $this->dispatchBrowserEvent('alert', ['message' => 'All selected appointment got updated return']);
        $this->reset(['selectedRows', 'selectPageRows']);
    }


    public function render()
    {
        $borrows = $this->borrows;
        $users = User::all();
        return view('livewire.admin.borrow-book.list-borrow-book',
        compact('borrows', 'users'));
    }
}
