<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentIdea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','theme','idea','caption','platform','status','meta'
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'content_idea_id');
    }
}
