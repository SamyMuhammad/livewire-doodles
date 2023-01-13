<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropdown extends Component
{
    public string $search;
    public array $searchResults = [];

    public function updatedSearch($newValue)
    {
        if (strlen($this->search) <= 1) {
            $this->searchResults = [];
            return;
        }
        $response = Http::get('https://itunes.apple.com/search?term='. $this->search .'&limit=5');
        $this->searchResults = $response->json()['results'];
        // dump($this->searchResults);
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
