@extends(env('THEME').'.front.layout')

@section('main')
<h1>@lang('Tournaments')</h1>
    @foreach($tournaments as $tournament)
    <div class="row">
        <div class="panel-body">
            <div class="col-md-3">
                <h4><a href="{{ url('tournaments/'.$tournament->slug) }}">{{ $tournament->title }}</a></h4>
                <div>{{ date('d.m.Y H:i', $tournament->start_time) }}</div>
            </div>
            <div class="col-md-3">
                <h5>@lang('Participants'):</h5>
                <div>{{ $tournament->participants_amount }}</div>
            </div>
            <div class="col-md-1">
                <h5>@lang('Fee'):</h5>
                <div>{{ $tournament->fee }}$</div>
            </div>
            <div class="col-md-1">
                <h5>@lang('Prize'):</h5>
                <div>{{ $tournament->prize }}$</div>
            </div>
            <div class="col-md-2">
                <a class="btn btn-primary" href="{{ url('tournaments/'.$tournament->slug) }}">@lang('Participate')</a>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        {{ $tournaments->links(env('THEME').'.front.pagination') }}
    </div>
@endsection