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

    public function status() {

    	$active = '<span class="badge badge-success">Active</span>';
    	$inactive = '<span class="badge badge-danger">Inactive</span>';

    	$status = ($this->active == '1') ? $active : $inactive;
    	return $status;
    }
}
