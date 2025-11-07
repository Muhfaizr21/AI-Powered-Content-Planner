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

    // 🔹 Halaman daftar ide konten
    public function index()
    {
        $contents = Content::latest()->get();

        return Inertia::render('ContentIdeas/Index', [
            'contents' => $contents
        ]);
    }

    // 🔹 Halaman form buat generate ide baru
    public function create()
    {
        return Inertia::render('ContentIdeas/Create');
    }

    // 🔹 Proses simpan ide konten baru
    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|string|max:255',
        ]);

        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a content planning assistant.'],
                ['role' => 'user', 'content' => 'Give me 5 content ideas for: ' . $request->theme],
            ],
        ]);

        $ideas = json_decode($response->body(), true)['choices'][0]['message']['content'] ?? 'No ideas generated.';

        $content = Content::create([
            'theme' => $request->theme,
            'ideas' => $ideas,
        ]);

        return redirect()->route('content.index')->with('success', 'Content ideas generated!');
    }
}
