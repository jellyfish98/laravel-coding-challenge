<?php

namespace App\Livewire;

use App\Services\ApiHandler;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowQuotesPage extends Component
{
    public $pageLoaded = false;

    public function getQuotes(): array
    {
        $this->pageLoaded = true;
        $response = ApiHandler::getFiveQuotes();
        return $response->getData();
    }

    #[layout('layouts.app')]
    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.show-quotes-page', [
            'quotes' => $this->pageLoaded
                ? $this->getQuotes()
                : [],
        ]);
    }
}
