<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tournaments\HeroClass;
use App\Repositories\HeroClassRepository;

class HeroClassController extends Controller
{
    /**
     * @var \App\Models\Tournaments\HeroClass
     */
    protected $model;

    /**
     * @var \App\Repositories\HeroClassRepository
     */
    protected $repository;

    /**
     * Create an instance of HeroclController
     * @param HeroClass $model
     * @param HeroClassRepository $heroClassRepository
     */
    public function __construct(HeroClass $model, HeroClassRepository $heroClassRepository)
    {
        $this->model = $model;
        $this->repository = $heroClassRepository;
    }



}
