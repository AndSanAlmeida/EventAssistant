<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class File extends Model
{
    protected $fillable = [
        'caption', 'file', 'event_id'
    ];
    
    public function event() {
    	return $this->belongsTo(Event::class);
    }

    public function getExtension($filePath) {
    	
    	$info = pathinfo($filePath);
        $ext = $info['extension'];

        return $ext;
    }	
}
