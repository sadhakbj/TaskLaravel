<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

/**
 * @property array information
 */
class UserCommentedOnPost extends Event
{
    use SerializesModels;
    public $comments;

    /**
     * Create a new event instance.
     *
     * @param array $information (Article Id and Users who are associated with it)
     */
    public function __construct(array $information)
    {
        $this->information = $information;
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
