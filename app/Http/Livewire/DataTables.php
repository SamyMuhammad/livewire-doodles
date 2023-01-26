<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use WithPagination;

    public $active = true;
    public $search = '';
    public $sortField;
    public $sortAsc = true;
    protected $queryString = [
        'search' => ['except' => ''],
        'active' => ['except' => true],
        'sortField' => ['except' => ''],
        'sortAsc' => ['except' => true],
    ];

    public function sortBy($field)
    {
        // To handle sorting type if user clicked more than once.
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $users = User::query()
            ->where(function ($query) {
                $query->where('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('email', 'LIKE', '%'.$this->search.'%');
            })
            ->where('active', $this->active)
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? "asc" : "desc");
            })
            ->paginate(10);
        return view('livewire.data-tables')->withUsers($users);
    }
}
