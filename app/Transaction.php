<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_id', 'amount', 'currency', 'status', 'costumer_name', 'costumer_email', 'event_id'
    ];

    public function event() {
    	return $this->belongsTo(Event::class);
    }
}
