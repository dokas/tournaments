<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NewsRepository;

class NewsController extends Controller
{

    /**
     * @var \App\Repositories\NewsRepository
     */
    protected $newsRepository;

    /**
     * The pagination number
     * @var int
     */
    protected $nbrPages;

    /**
     * Create a new NewsController instance
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->nbrPages = config('App.nbrPages.Front.News');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = $this->newsRepository->getOrderByDate($this->nbrPages);

        return view(env('THEME').'front.news.index', compact('posts'));
    }

}
