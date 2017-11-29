<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IngoingTrait;
use App\Events\ModelCreated;


class News extends Model
{
    use IngoingTrait;

    /**
     * The event map for the model
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ModelCreated::class,
    ];
}
