<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GetGoogleBooksApiService
{
    public function handle(int $startIndex)
    {
        $response = Http::withHeaders([
            'x-rapidapi-host' => config('services.rapidapi.host'),
            'x-rapidapi-key' => config('services.rapidapi.key'),
        ])->get(config('services.rapidapi.url') . '&startIndex=' . $startIndex);

        if (! optional(json_decode($response->body()))->items) {
            return null;
        }

        return $response->body();
    }
}
