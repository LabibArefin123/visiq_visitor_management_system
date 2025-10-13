<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class OpenAIModel extends Model
{
    protected $guarded = [];

    public static function getAIResponse($message)
    {
        $apiKey = env('OPENAI_API_KEY');
        $user = Auth::user(); // Fetch the authenticated user

        // You can add user-related context to the system message.
        $systemMessage = "You are an AI assistant. User: " . ($user ? $user->name : 'Guest');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model'    => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => $systemMessage], // Include the user's context in the system message
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.7,
        ]);

        return $response->json()['choices'][0]['message']['content'] ?? 'Sorry, I could not process your request.';
    }
}
