<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $uuid;
    public $major;
    public $minor;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($uuid, $major, $minor, $type)
    {
        //
        $this->uuid     = $uuid;
        $this->major    = $major;
        $this->minor    = $minor;
        $this->type     = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ['blereceiver'];
    }

    public function broadcastAs()
    {
        return 'BleEvent';
    }
}
