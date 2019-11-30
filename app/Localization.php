<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Localization extends Model
{
    protected $fillable = [
        'localization', 'latitude', 'longitude', 'event_id'
    ];
    
    public function event() {
    	return $this->belongsTo(Event::class);
    }
}
