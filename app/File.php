<?php

namespace App;
use App\Event;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{	

	protected $fillable = [
        'caption', 'file' 
    ];

    public function event() {
    	return $this->belongsTo(Event::class);
    }
}
