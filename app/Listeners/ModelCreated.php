<?php

namespace App\Listeners;

use App\Events\ModelCreated as EventModelCreated;
use App\Models\Ingoing;


class ModelCreated
{
    /**
     * Handle the event.
     *
     * @param  EventModelCreated  $event
     */
    public function handle(EventModelCreated $event)
    {
        $event->model->ingoing()->save(new Ingoing);
    }
}
