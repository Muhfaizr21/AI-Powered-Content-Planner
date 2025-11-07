<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OpenAIService
{
    protected $base = 'https://api.openai.com/v1';

    public function generateIdeas(string $theme, int $count = 5)
    {
        $prompt = "You are a creative social media strategist. Generate {$count} concise social media post ideas (title + short caption 1-2 sentences + 3 suggested hashtags) for this theme: \"{$theme}\". Output as JSON array of objects with keys: title, caption, hashtags. Be varied in tone and platform-agnostic.";

        $resp = Http::withToken(config('services.openai.key') ?? env('OPENAI_API_KEY'))
            ->post("{$this->base}/chat/completions", [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a social media content strategist.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.8,
                'max_tokens' => 800,
            ]);

        if ($resp->failed()) {
            throw new \Exception('OpenAI API request failed: ' . $resp->body());
        }

        $choices = $resp->json('choices', []);
        $text = $choices[0]['message']['content'] ?? ($resp->body());

        // attempt to extract JSON from text
        $json = $this->extractJson($text);

        if ($json) return $json;

        // fallback: naive parse by lines
        return [['title' => 'Generated Idea', 'caption' => $text, 'hashtags' => []]];
    }

    protected function extractJson($text)
    {
        // Find first [ and last ]
        $first = strpos($text, '[');
        $last = strrpos($text, ']');
        if ($first === false || $last === false) return null;
        $substr = substr($text, $first, $last - $first + 1);
        $data = json_decode($substr, true);
        return $data ?: null;
    }
}
