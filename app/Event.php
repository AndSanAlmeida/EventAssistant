<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Event extends Model
{	

	protected $fillable = [
        'name', 'name', 'date', 'hour', 'slug', 'active',
    ];

	// Disable Fillable (Aceita Tudo)
	// protected $guarded = [];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function isActive() {

    	$active = '<span class="badge badge-success">Active</span>';
    	$inactive = '<span class="badge badge-danger">Inactive</span>';

    	$status = ($this->active == '1') ? $active : $inactive;
    	return $status;
    }
}
