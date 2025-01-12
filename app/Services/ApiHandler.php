<?php

namespace App\Services;

use App;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ApiHandler
{
    public static function getFiveQuotes(): JsonResponse
    {
        $quotes = [];

        for ($i = 0; $i < 5; $i++) {
            $response = Http::get('https://api.kanye.rest/');

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to fetch quotes'], 500);
            }

            $quotes[] = $response->json()['quote'];
        }

        return response()->json($quotes);
    }
}
