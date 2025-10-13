<?php

namespace App\Models;

use OpenAI;

class OpenAIModel
{
    public static function getAIResponse($message)
    {
        $client = OpenAI::client(env('OPENAI_API_KEY'));

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-4', // Use 'gpt-3.5-turbo' if needed
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an AI assistant.'],
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

            return $response['choices'][0]['message']['content'] ?? 'No response received.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
