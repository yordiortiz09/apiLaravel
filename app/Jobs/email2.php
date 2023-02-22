<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Mail\SendMail2;
use Illuminate\Support\Facades\Mail;

class email2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected  $user;
    protected $nombre;
    // protected  $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$correo)//, $url,$numero_aleatorio2)
    {
        // $queryString = parse_url($url, PHP_URL_QUERY);
        // $todojunto=$numero_aleatorio2.$queryString;
        $this->user = $user;
        $this->nombre=$correo;
        // $this->url = $todojunto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new SendMail2($this->user, $this->nombre));
      //  Log::info('Mail Sent');
    }
}
