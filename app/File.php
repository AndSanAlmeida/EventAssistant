<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'caption', 'file', 'event_id'
    ];
    
    public function event() {
    	return $this->belongsTo(Event::class);
    }
}
