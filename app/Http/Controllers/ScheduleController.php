<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ContentIdea;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'content_idea_id' => 'required|exists:content_ideas,id',
            'scheduled_at' => 'required|date',
            'platform' => 'required|string',
        ]);

        $content = ContentIdea::findOrFail($data['content_idea_id']);
        $this->authorize('update', $content);

        $schedule = Schedule::create([
            'content_idea_id' => $content->id,
            'scheduled_at' => $data['scheduled_at'],
            'platform' => $data['platform'],
            'status' => 'pending',
        ]);

        $content->update(['status' => 'scheduled']);

        return redirect()->back()->with('success','Scheduled.');
    }

    // add index/show/update if needed
}
