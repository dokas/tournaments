@extends(env('THEME').'.front.layout')

@section('main')
<div class="col-md-9">
    <h1>{{ $tournament->title }}</h1>
    <div class="panel-default">
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <li class="nav-item active"><a class="nav-link" href="{{ url('tournaments/'.$tournament->slug) }}">@lang('Overview')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('tournaments/'.$tournament->slug.'/rules') }}">@lang('Rules')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('tournaments/'.$tournament->slug.'/participants') }}">@lang('Participants')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('tournaments/'.$tournament->slug.'/grid') }}">@lang('Grid')</a></li>
            </ul>
        </nav>
        <div class="panel-body bg-light">
            @yield('section')
        </div>
    </div>
</div>
<div class="col-md-3">
    @if(!$tournament->isStarted())
    <p>Турнир начинается через: <br>01 день 8 часов 30 минут</p>
    @endif
    <div class="panel-body bg-light">
        @if(!$tournament->isStarted())
        <p>@lang('Registration is available')</p>
        <p> {{ count($tournament->participants) }} / {{ $tournament->participants_amount }} @lang('Participants registered')</p>
        @endif
        @if(Auth::check())
            @if($currentParticipant)
                @if(!$tournament->isStarted() && !$currentParticipant->confirmed)
                    <h4>@lang('Confirm participation')</h4>
                    <p>@lang('You have been registered on the tournament. Confirm your participation in:')</p>
                    <p>01 День 2 Часов 30 минут</p>
                @endif
                @if($currentParticipant->confirmed)
                    <div class="mb-3">
                        <p>@lang('Open your match')</p>
                        <p>@lang('Your opponent has been found.')</p>
                        <a class="btn btn-primary" href="{{ route('tournaments.participants.confirm', [$tournament->id]) }}">@lang('Open')</a>
                    </div>
                @else
                    <div class="mb-3">
                        <a class="btn btn-primary" href="{{ route('tournaments.participants.confirm', [$tournament->id]) }}">@lang('Confirm')</a>
                    </div>
                    <div class="mb-3">
                        <a class="btn" href="{{ route('tournaments.participants.cancel', [$tournament->id]) }}">@lang('Cancel registration')</a>
                    </div>
                    <div class="mb-3">
                        <p>@lang('Your classes for tournament')</p>
                    </div>
                    <div class="mb-3">
                        <a class="btn" href="{{ route('tournaments.display.classes', [$tournament->slug]) }}">@lang('Change classes')</a>
                    </div>
                @endif
            @else
                <h4>@lang('Register on the tournament')</h4>
                <p>@lang('You need to confirm your participation one hour before the start')</p>
                <div class="mb-3">
                    <a class="btn btn-primary" href="{{ route('tournaments.participants.store', [$tournament->id]) }}">@lang('Participate')</a>
                </div>
            @endif

        @else
            <h4>@lang('Create an account')</h4>
            <p>@lang('You need to register or to login on the website to participate in the tournament')</p>
            <div class="mb-3">
                <a class="btn btn-primary" href="{{ route('register') }}">@lang('Register')</a>
            </div>
            <div class="mb-3">
                <a class="btn btn-primary" href="{{ route('login') }}">@lang('Login')</a>
            </div>
        @endif
    </div>
</div>
@endsection