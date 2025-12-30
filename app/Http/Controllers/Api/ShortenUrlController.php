<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShortenUrlRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ShortenedUrl;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ShortenUrlController extends Controller
{
    public function shortenUrl(ShortenUrlRequest $request)
    {
        try {
            $validated = $request->validated();

            // Check if URL already exists for this user
            $existingShortenedUrl = ShortenedUrl::where('user_id', $request->user()->id)
                ->where('original_url', $validated['original_url'])
                ->first();

            if ($existingShortenedUrl) {
                return response()->json([
                    'status' => true,
                    'message' => 'URL already shortened',
                    'data' => [
                        'end_point' => 'api/s/' . $existingShortenedUrl->short_code,
                        'short_code' => $existingShortenedUrl->short_code,
                        'short_url' => url("api/s/{$existingShortenedUrl->short_code}"),
                        'original_url' => $existingShortenedUrl->original_url,
                        'created_at' => Carbon::parse($existingShortenedUrl->created_at)->format('d-m-Y'),
                    ]
                ], 200);
            }

            $shortCode = $this->generateUniqueShortCode();

            $shortenedUrl = ShortenedUrl::create([
                'user_id' => $request->user()->id,
                'short_code' => $shortCode,
                'original_url' => $validated['original_url'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'URL shortened successfully',
                'data' => [
                    'end_point' => 'api/s/' . $shortenedUrl->short_code,
                    'short_code' => $shortenedUrl->short_code,
                    'short_url' => url("api/s/{$shortenedUrl->short_code}"),
                    'original_url' => $shortenedUrl->original_url,
                    'created_at' => Carbon::parse($shortenedUrl->created_at)->format('d-m-Y'),
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while shortening the URL',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Generate a unique short code
    private function generateUniqueShortCode(int $length = 6): string
    {
        do {
            $shortCode = Str::random($length);
        } while (ShortenedUrl::where('short_code', $shortCode)->exists());

        return $shortCode;
    }
}
