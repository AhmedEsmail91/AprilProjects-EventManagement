<?php

namespace App\Models;

use \App\Http\Traits\CanLoadRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory,CanLoadRelationships;
    // fillable
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        "user_id"
    ];
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
