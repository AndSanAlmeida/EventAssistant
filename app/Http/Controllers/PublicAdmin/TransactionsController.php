<?php

namespace App\Http\Controllers\PublicAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Braintree\Gateway as Braintree;
use Illuminate\Support\Str;

class TransactionsController extends Controller
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
	        $transaction = $result->transaction;
	        return back()->with('success', 'Transaction successful. The ID is:'. $transaction->id);
	    } else {
	        $errorString = "";
	        foreach ($result->errors->deepAll() as $error) {
	            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
	        }
	        return back()->with('Error', 'An error occurred with the message: '. $result->message);
	    }
    }
}
