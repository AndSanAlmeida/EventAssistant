<?php

namespace App;
use App\Event;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'event_id'
    ];

    public function event() {
    	return $this->belongsTo(Event::class);
    }
}
