<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Event extends Model
{	

	// protected $fillable = [
 //        'name', 'name', 'date', 'hour', 'slug', 'active',
 //    ];

	// Disable Fillable
	protected $guarded = [];

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
