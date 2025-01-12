<?php

namespace App\Http\Controllers;

use App\Services\ApiHandler;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function getQuotes(Request $request)
    {
        // Get the X-API-TOKEN.
        $token = $request->header('X-API-TOKEN');

        // Check if the token is valid. If it is, return the quotes.
        if ($this->isTokenValid($token)) {
            return ApiHandler::getFiveQuotes();
        }

        // Return a 401 Unauthorized response if the token is invalid.
        return response()->json([
            'error' => 'Unauthorized',
        ], 401);
    }


    public function isTokenValid($token): bool
    {
        $validToken = config('app.valid_api_key');
        return $token === $validToken;
    }
}
