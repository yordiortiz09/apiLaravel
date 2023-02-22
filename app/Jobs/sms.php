<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class sms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
   # protected $url;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user=$user;
    #    $this->url =$url; 
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
          Http::post('https://rest.nexmo.com/sms/json', [
             "from"=>"Vonage APIs",
             'api_key' => "7beade0e",
             'api_secret' => "HFNnWOFyNs16m3BA",
             'to' => "52{$this->user->telefono}",
             'text' => "Tu codigo de verificacion es: {$this->user->no°verificación}, sigue las instrucciones en tu correo electronico",
         ]);

    }
}
