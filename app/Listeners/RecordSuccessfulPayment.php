<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordSuccessfulPayment
{
    /**
     * @var Transaction_id
     */
    protected $transaction_id;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }
    /**
     * Update the Payments table with the 'transaction_id' from BrainTree.
     *
     * @param  OrderWasCreated  $event
     * @return void
     */
    public function handle(OrderWasCreated $event)
    {
        $event->order->payment()->create([
            'failed' => false,
            'transaction_id' => $this->transaction_id,
        ]);
        notify()->flash('Sweet!', 'success', [
            'text' => 'Your order has been placed.',
        ]);
    }
}
