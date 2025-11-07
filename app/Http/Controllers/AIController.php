<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AIController extends Controller
{
    protected $openai;

    public function __construct(OpenAIService $openai)
    {
        $this->openai = $openai;
    }

    public function generate(Request $request)
    {
        $request->validate(['theme' => 'required|string|max:255', 'count' => 'nullable|int|min:1|max:10']);
        $count = $request->input('count', 5);
        $theme = $request->input('theme');

        // call service
        $ideas = $this->openai->generateIdeas($theme, $count);

        // we can optionally cache the result to avoid re-calls (cache key = user + theme + timestamp granularity)
        $cacheKey = 'openai_ideas_'.md5($theme.'_'.Auth::id());
        cache()->put($cacheKey, $ideas, now()->addMinutes(30));

        return response()->json(['ideas' => $ideas]);
    }
}
