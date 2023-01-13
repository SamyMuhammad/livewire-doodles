<?php

namespace Tests\Feature;

use App\Http\Livewire\SearchDropdown;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchDropdownTest extends TestCase
{
    /**
     * @test
     */
    public function search_page_contains_dropdown_livewire_component()
    {
        $this->get('/search')
        ->assertSeeLivewire('search-dropdown');
    }

    /**
     * @test
     */
    public function search_dropdown_searches_correctly_if_track_exists()
    {
        Livewire::test(SearchDropdown::class)
            ->assertDontSee('Adele')
            ->set('search', 'hello')
            ->assertSee('Adele');
    }

    /**
     * @test
     */
    public function search_dropdown_searches_correctly_if_no_track_exists()
    {
        Livewire::test(SearchDropdown::class)
            ->set('search', 'hello;lkscasskjdnclksak;l')
            ->assertSee('No Results Found For');
    }
}
