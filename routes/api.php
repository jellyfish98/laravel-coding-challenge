<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('quotes', 'App\Http\Controllers\QuoteController@getQuotes');

