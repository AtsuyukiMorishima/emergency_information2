<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyEventTag extends Model
{
    use HasFactory;

    /** @var string[] */
    protected $fillable = [
        'emergency_event_ee_id',
        'tag_id',
    ];
}
