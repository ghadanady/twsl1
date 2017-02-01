<?php

namespace App\Events;
use App\Order;
use App\Basket\Basket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderWasCreated
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Instance of Order.
     *
     * @var Order
     */
    public $order;
    /**
     * Instance of Basket.
     *
     * @var Basket
     */
    public $basket;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, Basket $basket)
    {
        $this->order = $order;
        $this->basket = $basket;
    }
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
