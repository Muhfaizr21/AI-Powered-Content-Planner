<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Content;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContentController extends Controller
{
    use AuthorizesRequests;

    // Halaman form buat generate ide konten
    public function create()
    {
        return Inertia::render('ContentIdeas/Create');
    }

    // Simpan hasil ide konten dari AI
    public function store(Request $request)
    {
        // 🔹 Untuk sementara nonaktifkan policy
        // $this->authorize('create', Content::class);

        $request->validate([
            'theme' => 'required|string|max:255',
        ]);

        // 🔹 Panggil OpenAI API untuk generate ide
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a content planning assistant.'],
                ['role' => 'user', 'content' => 'Give me 5 content ideas for: ' . $request->theme],
            ],
        ]);

        $ideas = json_decode($response->body(), true)['choices'][0]['message']['content'] ?? 'No ideas generated.';

        // 🔹 Simpan hasil ke database
        $content = Content::create([
            'theme' => $request->theme,
            'ideas' => $ideas,
        ]);

        return redirect()->back()->with('success', 'Content ideas generated!');
    }
}
