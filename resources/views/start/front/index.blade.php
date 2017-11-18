@extends(env('THEME').'.front.layout')

@section('main')
<h1>Bootstrap starter template</h1>
<p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
    
<div class="home-news">
    <div class="row">
        @foreach($news as $item)
        <div class="col-md-4">
            <div class="card-body">
                <div class="img">
                    {{ $item->img }}
                </div>
                <div class="title">
                    {{ $item->title }}
                </div>
                <div class="description">
                    {{ $item->description }}
                </div>
                <div class="date">
                    {{ $item->created_at }}
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endsection

