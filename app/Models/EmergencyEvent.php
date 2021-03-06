<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmergencyEvent extends Model
{
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'emergency_events';

    /** @var string */
    protected $primaryKey = 'ee_id';

    /** @var string[] */
    protected $fillable = [
        'event_title',
        'event_date',
    ];

    /** @var string[] */
    protected $dates = [
        'event_date',
    ];

    /** @return \Illuminate\Database\Eloquent\Relations\HasMany */
    public function siteUrls(): HasMany
    {
        return $this->hasMany(SiteUrl::class, 'ee_id', 'ee_id');
    }

    public function tags()
    {

        return $this->belongsToMany('App\Models\Tag', 'emergency_event_tags');
    }
}
