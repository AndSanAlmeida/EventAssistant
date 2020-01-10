<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\File;
use App\Localization;
use App\Transaction;

class Event extends Model
{	
	// Disable Fillable (Aceita Tudo)
	// protected $guarded = [];

	protected $fillable = [
        'name', 'date', 'hour', 'website', 'slug', 'active',
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function isActive() {

    	$active = '<span class="badge badge-success">Active</span>';
    	$inactive = '<span class="badge badge-danger">Inactive</span>';

    	$status = ($this->active == '1') ? $active : $inactive;
    	return $status;
    }

    public function getStatus($status) {

        return $status;
    }

    public function files() {
        return $this->hasMany(File::class);
    }

    public function localizations() {
        return $this->hasMany(Localization::class);
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
