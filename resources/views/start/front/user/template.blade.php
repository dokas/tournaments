@extends(env('THEME').'.front.layout')

@section('main')
    <h1>@lang('Personal cabinet')</h1>
    <div class="row">
        <div class="col-md-9">
            <div class="panel-default">
                <nav class="navbar navbar-default">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active"><a class="nav-link" href="{{ route('profile') }}">@lang('Profile')</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.settings') }}">@lang('Settings')</a></li>
                    </ul>
                </nav>
                <div class="panel-body">
                    @yield('profile-body')
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
@endsection