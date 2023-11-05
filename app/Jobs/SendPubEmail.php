<?php

namespace App\Jobs;

use App\Mail\PubEmail;
use App\Models\Cars;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPubEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $cars;
    public function __construct(Cars $cars ,private $email)
    {
        $this->cars = $cars;
    }

    /**
     * Execute the job.
     */
    public function handle():void
    {
        Mail::to($this->email)->send(new PubEmail($this->cars));
    }
}
