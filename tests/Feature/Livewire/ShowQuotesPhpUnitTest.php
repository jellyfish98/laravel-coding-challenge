<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ShowQuotesPage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ShowQuotesPhpUnitTest extends TestCase
{
    /** @test */
    public function requires_authentication_to_access_the_page(): void
    {
        $this->get(route('quotes'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function can_access_page_when_logged_in(): void
    {
        $user = User::factory()->create();
        Auth::login($user);
        $this->get(route('quotes'))
            ->assertOk();
    }

    /** @test */
    public function displays_kanye_west_quotes_when_the_page_loads(): void
    {
        Http::fake([
            'api.kanye.rest/*' => Http::sequence()
                ->push(['quote' => 'Test quote 1'])
                ->push(['quote' => 'Test quote 2'])
                ->push(['quote' => 'Test quote 3'])
                ->push(['quote' => 'Test quote 4'])
                ->push(['quote' => 'Test quote 5']),
        ]);

        Livewire::test(ShowQuotesPage::class)
            ->assertDontSee('Test quote 1')
            ->set('pageLoaded', true)
            ->assertSeeInOrder([
                'Test quote 1',
                'Test quote 2',
                'Test quote 3',
                'Test quote 4',
                'Test quote 5',
            ]);
    }
}
