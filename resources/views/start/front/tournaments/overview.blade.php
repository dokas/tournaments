@extends(env('THEME').'.front.tournaments.tournament')

@section('section')
    <div class="col-md-5">
        <div class="row">
            <h6>@lang('Game')</h6>
            <div><strong>{{ $tournament->getGame()->name }}</strong></div>
        </div>
        <div class="row">
            <h6>@lang('Date and time of the event')</h6>
            <div><strong>{{ date('d.m.Y H:i', $tournament->start_time) }}</strong></div>
        </div>
        <div class="row">
            <h6>@lang('Participants amount')</h6>
            <div><strong>{{ $tournament->participants_amount }}</strong></div>
        </div>
        <div class="row">
            <h6>@lang('Fee')</h6>
            <div><strong>{{ $tournament->fee }}$</strong></div>
        </div>
        <div class="row">
            <h6>@lang('Prize')</h6>
            <div><strong>{{ $tournament->prize }}$</strong></div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="pull-left">
            {{ $tournament->img }}
        </div>
        <div class="row">
            <h3>{{ $tournament->title }}</h3>
            <div>{!! $tournament->description !!}</div>
        </div>
    </div>
@endsection