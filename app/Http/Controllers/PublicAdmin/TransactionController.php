<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;
use Braintree\Gateway as Braintree;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function checkout(Request $request, $id)
    {	
    	$user = User::findOrFail($id);

    	$gateway = new Braintree([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

    	// First and Last Name
    	if ( !preg_match('/\s/', $user->name)) {
    		$firstname = $user->name;
    		$lastname = '';
    	} else {
    		list($firstname, $lastname) = explode(' ', $user->name);
    	}
        
	    $amount = 10;
	    $nonce = $request->payment_method_nonce;

	    $result = $gateway->transaction()->sale([
	        'amount' => $amount,
	        'paymentMethodNonce' => $nonce,
	        'customer' => [
	            'firstName' => trim($firstname),
	            'lastName' => trim($lastname),
	            'email' => $user->email,
	        ],
	        'options' => [
	            'submitForSettlement' => true
	        ]
	    ]);

	    if ($result->success) {

	    	// dd($result->transaction);
	        $newTransaction = new Transaction;
	    	$newTransaction->transaction_id = $result->transaction->id;   	
	    	$newTransaction->amount = $result->transaction->amount;   	
	    	$newTransaction->currency = $result->transaction->currencyIsoCode;   	
	    	$newTransaction->status = $result->transaction->status;   	
	    	$newTransaction->costumer_name = $user->name;   	
	    	$newTransaction->costumer_email = $user->email;
	    	event()->transaction()->create($newTransaction); 	

	        return back()->with('success', 'Transaction successful.');
	    } else {
	        $errorString = "";
	        foreach ($result->errors->deepAll() as $error) {
	            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
	        }
	        return back()->withErrors('Error', 'An error occurred with the message: '. $result->message);
	    }
    }
}
