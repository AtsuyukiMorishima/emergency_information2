<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    protected $fillable = ['tag_name'];

    public function emergency_events()
    {
        return $this->belongsToMany('App\Models\EmergencyEvent', 'emergency_event_tags');
    }
}
