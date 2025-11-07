<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Content;
use Inertia\Inertia;

class ContentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['theme' => 'required|string|max:255']);

        // Kirim ke OpenAI API
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a creative marketing AI.'],
                ['role' => 'user', 'content' => "Give me 3 content ideas about: {$request->theme}"],
            ],
        ]);

        $ideas = $response->json('choices.0.message.content') ?? 'No ideas generated.';

        // Simpan ke database
        $content = Content::create([
            'theme' => $request->theme,
            'ideas' => $ideas,
        ]);

        // Redirect ke halaman hasil
        return redirect()->route('contents.show', $content->id);
    }

    public function show(Content $content)
    {
        return inertia('ContentIdeas/Show', [
            'content' => $content
        ]);
    }
    public function create()
{
    return Inertia::render('Contents/Create');
}

}
