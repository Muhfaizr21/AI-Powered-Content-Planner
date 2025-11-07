<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'theme' => 'required|string|max:255',
        ]);

        try {
            // 🔹 Panggil OpenAI API
            $response = Http::withToken(env('OPENAI_API_KEY'))->post(
                'https://api.openai.com/v1/chat/completions',
                [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional content strategist.'],
                        ['role' => 'user', 'content' => 'Generate 5 content ideas for: ' . $request->theme],
                    ],
                ]
            );

            if ($response->failed()) {
                Log::error('AI API failed', ['response' => $response->body()]);
                return response()->json(['error' => 'AI request failed'], 500);
            }

            $data = $response->json();

            $ideas = $data['choices'][0]['message']['content'] ?? 'No ideas generated.';

            return response()->json([
                'theme' => $request->theme,
                'ideas' => $ideas,
            ]);

        } catch (\Exception $e) {
            Log::error('AI Generation Error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
