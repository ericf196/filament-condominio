<?php

namespace App\Jobs;

use App\Models\Owner;
use App\Models\User;
use App\Notifications\EmailCondominiumBill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailCondominiumBill implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $condominiumBill;
    /**
     * Create a new job instance.
     */
    public function __construct($condominiumBill)
    {
        $this->condominiumBill = $condominiumBill;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $owners = Owner::all();

        $owners->each(function ($owner, $key) {

            $owner->notify(new EmailCondominiumBill($owner, $this->condominiumBill));
        });
    }
}
