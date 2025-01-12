<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use App\Livewire\ShowQuotesPage;
use Illuminate\Support\Facades\Http;

it('requires authentication to access the page', function () {
    $this->get(route('quotes'))
        ->assertRedirect(route('login'));
});

it('can access page when logged in', function () {
    $user = User::factory()->create();
    Auth::login($user);
    $this->get(route('quotes'))
        ->assertOk();
});

it('displays Kanye West quotes when the page loads', function () {
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
});
