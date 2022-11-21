<?php

namespace App\Http\Livewire\Admin\Publishers;

use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListPublisherForm extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;

    public $publisherIdBeginRemoved = null;

    protected $listeners = ['deleteConfirmed' => 'deletePublisher'];

    public function confirmPublisherRemoval($publisherId) {
        $this->publisherIdBeginRemoved = $publisherId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deletePublisher() {
        Publisher::query()->whereIn('_id', [$this->publisherIdBeginRemoved])
            ->update(['deleted' => Carbon::now()->toDateTimeString()]);
        $this->dispatchBrowserEvent('deleted', ['message' => 'Publisher deleted success']);
    }

    public function render()
    {
        $publishers = Publisher::query()
            ->where('deleted', null)
            ->where(function ($query) {
                if(!empty($this->searchTerm)) {
                    $query->where('name', 'LIKE', '%' .$this->searchTerm. '%');
                }
            })
            ->latest()
            ->paginate(5);
        return view('livewire.admin.publishers.list-publisher-form', compact('publishers'));
    }
}
