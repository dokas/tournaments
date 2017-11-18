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
     * Get post for home page
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
}
