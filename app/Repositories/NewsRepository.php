<?php

namespace App\Repositories;

use App\Models\News;
use Config;

class NewsRepository
{
    /**
     * The model instance
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * Create a new NewsRepository instance.
     * @param  \App\Models\News $news
     */
    public function __construct(News $news) 
    {
        $this->model = $news;
    }
    
    /**
     * Get news for home page
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHome()
    {
        return $this->model
            ->select('*')
            ->limit(Config::get('settings.home_news_count'))
            ->latest()
            ->get();
    }

    /**
     * Create a query for News
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function queryOrderByDate()
    {
        return $this->model
            ->select('title', 'alias', 'description', 'created_at')
            ->whereActive(true)
            ->latest();
    }

    /**
     * Get news collections paginated
     * @param $nbrPages
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOrderByDate($nbrPages)
    {
        return $this->queryOrderByDate()->paginate($nbrPages);
    }

    /**
     * Get all news collection paginated.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {
        return $this->model->with ('ingoing')
            ->orderBy ($parameters['order'], $parameters['direction'])
            ->when ($parameters['active'], function ($query) {
                $query->whereActive (true);
            })->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })->when (auth()->user()->role === 'redac', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('users.id', auth()->id());
                });
            })->paginate ($nbrPages);
    }
}
