<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SmsController extends Controller
{
    //
   public function registrarSMS(Request $request)
   {
    $validacion=Validator::make($request->all(),[
        'numero'=>'required|max:10',
        'token'=>'required'
       
 
         ]);
         if($validacion->fails()){
             return response()->json([
                 "error"=>$validacion->errors()
 
             ],400);
            }
           // $user = User::where('email', $request->email)->first();
            $basic  = new \Vonage\Client\Credentials\Basic("f2d2f411","yLFlYVN9J9ENr7b5");
            $client = new \Vonage\Client($basic);
    
    
            
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("52.$request->numero", 'UTT', 'A text message sent using the Nexmo SMS API')
            );
            
            $message = $response->current();
            
            if ($message->getStatus() == 0) {
                echo "The message was sent successfully\n";
            } else {
                echo "The message failed with status: " . $message->getStatus() . "\n";
            }
   }
}
