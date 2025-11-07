<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_idea_id','scheduled_at','status','platform'
    ];

    protected $dates = ['scheduled_at'];

    public function contentIdea()
    {
        return $this->belongsTo(ContentIdea::class, 'content_idea_id');
    }
}
