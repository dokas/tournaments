<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Back\Indexable;
use App\Repositories\NewsRepository;
use App\Models\News;

class NewsController extends Controller
{

    use Indexable;

    /**
     * Create a new NewsController instance
     * @param \App\Repositories\NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository) {
        $this->repository = $newsRepository;

        $this->table = 'news';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new news.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(env('THEME').'.back.news.create');
    }

    /**
     * Display the news.
     *
     * @param  \App\Models\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view(env('THEME').'.back.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
