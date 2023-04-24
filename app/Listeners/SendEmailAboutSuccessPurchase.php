<?php

namespace App\Listeners;

use App\Events\PurchaseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailAboutSuccessPurchase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PurchaseEvent $event)
    {
        file_put_contents('test.txt', $event->message);
    }
}
