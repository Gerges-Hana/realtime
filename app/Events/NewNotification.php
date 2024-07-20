<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NewNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $post_id;
    public $user_id;
    public $comments;
    public $date;
    public $time;
    public $user_name;
  
    public function __construct($data)
    {
        $this->post_id=$data['post_id'];
        $this->user_id=$data['user_id'];
        $this->comments=$data['comments'];
        $this->user_name=$data['user_name'];
        $this->date=date("Y M d",strtotime(Carbon::now()));
        $this->time=date("h:i A",strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('new-notification'),
        ];
    }
}
