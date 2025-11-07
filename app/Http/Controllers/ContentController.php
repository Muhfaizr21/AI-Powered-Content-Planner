<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Content;
use Inertia\Inertia;

class ContentController extends Controller
{
    /**
     * 🔹 Tampilkan daftar semua konten (halaman Index)
     */
    public function index()
    {
        $contents = Content::latest()->get();

        return Inertia::render('Contents/Index', [
            'contents' => $contents,
        ]);
    }

    /**
     * 🔹 Halaman form input tema (Create page)
     */
    public function create()
    {
        return Inertia::render('Contents/Create');
    }

    /**
     * 🔹 Simpan tema & hasil AI ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|string|max:255',
        ]);

        // Panggil API OpenAI
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a creative marketing AI.'],
                ['role' => 'user', 'content' => "Give me 3 content ideas about: {$request->theme}"],
            ],
        ]);

        $ideas = $response->json('choices.0.message.content') ?? 'No ideas generated.';

        // Simpan hasil ke DB
        $content = Content::create([
            'theme' => $request->theme,
            'ideas' => $ideas,
        ]);

        // ✅ Langsung render halaman hasil
        return Inertia::render('Contents/Show', [
            'content' => $content,
        ]);
    }

    /**
     * 🔹 Tampilkan 1 hasil ide (halaman detail)
     */
    public function show(Content $content)
    {
        return Inertia::render('Contents/Show', [
            'content' => $content,
        ]);
    }
}
