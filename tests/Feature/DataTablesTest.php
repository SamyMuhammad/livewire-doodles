<?php

namespace Tests\Feature;

use App\Http\Livewire\DataTables;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DataTablesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function users_page_contains_datatable_livewire_component()
    {
        $this->get('/users')
            ->assertSeeLivewire('data-tables');
    }

    /**
     * @test
     */
    public function active_checkbox_filters_data_correctly()
    {
        $activeUser = User::factory()->create(['active' => 1]);
        $inactiveUser = User::factory()->create(['active' => 0]);

        Livewire::test(DataTables::class)
            ->assertSee($activeUser->name)
            ->assertDontSee($inactiveUser->name)
            ->set('active', false)
            ->assertSee($inactiveUser->name)
            ->assertDontSee($activeUser->name);
    }

    /**
     * @test
     */
    public function datatable_searches_name_correctly()
    {
        $userA = User::factory()->create(['active' => 1]);
        $userB = User::factory()->create(['active' => 1]);

        Livewire::test(DataTables::class)
            ->set('search', $userA->name)
            ->assertDontSee($userB->name)
            ->assertSee($userA->name);
    }

    /**
     * @test
     */
    public function datatable_searches_email_correctly()
    {
        $userA = User::factory()->create(['active' => 1]);
        $userB = User::factory()->create(['active' => 1]);

        Livewire::test(DataTables::class)
            ->set('search', $userA->email)
            ->assertDontSee($userB->name)
            ->assertSee($userA->name);
    }

    /**
     * @test
     */
    public function datatables_sorts_name_asc_correctly()
    {
        User::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'Andre A'],
                ['name' => 'Bovana B'],
                ['name' => 'Carlos C'],
            ))
            ->create(['active' => 1]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'name')
            ->assertSeeInOrder(['Andre A', 'Bovana B', 'Carlos C']);
    }

    /**
     * @test
     */
    public function datatables_sorts_name_desc_correctly()
    {
        User::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'Andre A'],
                ['name' => 'Bovana B'],
                ['name' => 'Carlos C'],
            ))
            ->create(['active' => 1]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'name')
            ->call('sortBy', 'name')
            ->assertSeeInOrder(['Carlos C', 'Bovana B', 'Andre A']);
    }

    /**
     * @test
     */
    public function datatables_sorts_email_asc_correctly()
    {
        User::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'Andre A', 'email' => 'andre@email.com'],
                ['name' => 'Bovana B', 'email' => 'bovana@email.com'],
                ['name' => 'Carlos C', 'email' => 'carlos@email.com'],
            ))
            ->create(['active' => 1]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'email')
            ->assertSeeInOrder(['Andre A', 'Bovana B', 'Carlos C']);
    }

    /**
     * @test
     */
    public function datatables_sorts_email_desc_correctly()
    {
        User::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'Andre A', 'email' => 'andre@email.com'],
                ['name' => 'Bovana B', 'email' => 'bovana@email.com'],
                ['name' => 'Carlos C', 'email' => 'carlos@email.com'],
            ))
            ->create(['active' => 1]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'email')
            ->call('sortBy', 'email')
            ->assertSeeInOrder(['Carlos C', 'Bovana B', 'Andre A']);
    }
}
