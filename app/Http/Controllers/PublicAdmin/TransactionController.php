<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Transaction;
use Braintree\Gateway as Braintree;

class TransactionController extends Controller
{
    public function checkout(Request $request, $id)
    {	
    	$event = Event::findOrFail($id);

    	$gateway = new Braintree([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

    	// First and Last Name
    	if ( !preg_match('/\s/', $event->user->name)) {
    		$firstname = $event->user->name;
    		$lastname = '';
    	} else {
    		list($firstname, $lastname) = explode(' ', $event->user->name);
    	}
        
	    $amount = 10;
	    $nonce = $request->payment_method_nonce;

	    $result = $gateway->transaction()->sale([
	        'amount' => $amount,
	        'paymentMethodNonce' => $nonce,
	        'customer' => [
	            'firstName' => trim($firstname),
	            'lastName' => trim($lastname),
	            'email' => $event->user->email,
	        ],
	        'options' => [
	            'submitForSettlement' => true
	        ]
	    ]);

	    // dd($result);

	    if ($result->success) {

	    	// Create new Transaction
	        $newTransaction = new Transaction;
	    	$newTransaction->transaction_id = $result->transaction->id;   	
	    	$newTransaction->amount = $result->transaction->amount;   	
	    	$newTransaction->currency = $result->transaction->currencyIsoCode;   	
	    	$newTransaction->status = $result->transaction->status;   	  	
	    	$newTransaction->customer_name = $event->user->name;   	
	    	$newTransaction->customer_email = $event->user->email;
	    	$newTransaction->user_id = $event->user_id;
	    	$event->transaction()->save($newTransaction);

	    	// Update Event Status
	    	$event->update(['active' => '1']);

	        return back()->with('success', 'Transaction successful. Your link is now available!');
	    } else {
	        $errorString = "";
	        foreach ($result->errors->deepAll() as $error) {
	            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
	        }
	        return back()->withErrors('error', 'An error occurred with the message: '. $result->message);

	        // return back()->with('error', 'An error occurred with the message: '. $result->message);
	    }
    }
}
