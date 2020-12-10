<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $field;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if ($this->field->from_user == "partner") {
            $to_user = "member";
            $to_id = (string) $this->field->id_member;
        } else {
            $to_user = "partner";
            $to_id = (string) $this->field->id_pengelola;
        }

        return new Channel('channel-chat-' . $to_user . '.' . $to_id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return json_decode($this->field, true);
        // $message = json_decode((new MessageResource($this->field))->toJson(), true);
        // return $message;
    }
}
