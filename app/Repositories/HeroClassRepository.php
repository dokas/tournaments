<?php

namespace App\Repositories;

use App\Models\Tournaments\HeroClass;


class HeroClassRepository
{

    /**
     * The model instance
     * @var \App\Models\Tournaments\HeroClass
     */
    protected $model;

    /**
     * Create a HeroClassRepository instance
     * @param HeroClass $heroClass
     */
    public function __construct(HeroClass $heroClass)
    {
        $this->model = $heroClass;
    }



}

