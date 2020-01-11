<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Event;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_id', 'amount', 'currency', 'status', 'customer_name', 'customer_email', 'event_id', 'user_id'
    ];

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function event() {
    	return $this->belongsTo(Event::class);
    }

    public function getTransactionStatus() {

    	$status = ($this->status == 'settling' || $this->status == 'submitted_for_settlement') ? true : false;
    	return $status;
    }
}
