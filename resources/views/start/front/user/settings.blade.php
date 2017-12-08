@extends(env('THEME').'.front.user.template')

@section('profile-body')

    @if (session('user-updated'))
        @component(env('THEME').'.front.components.alert')
        @slot('type')
        success
        @endslot
        {!! session('user-updated') !!}
        @endcomponent
    @endif

    <form method="post" action="{{ route('profile.update') }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="login">@lang('Login')</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="@lang('Login')" value="{{ $user->login }}">
                    {!! $errors->first('login','<span class="help-block">:message</span> ') !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="email">@lang('Email')</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="@lang('Email')" value="{{ $user->email }}">
                    {!! $errors->first('email','<span class="help-block">:message</span> ') !!}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">@lang('Password')</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="@lang('Password')">
                    {!! $errors->first('password','<span class="help-block">:message</span> ') !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">@lang('Password confirmation')</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('Password confirmation')">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">@lang('Name')</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="@lang('Name')" value="{{ $user->name }}">
                    {!! $errors->first('name','<span class="help-block">:message</span> ') !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="name">@lang('Surname')</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="@lang('Surname')" value="{{ $user->surname }}">
                    {!! $errors->first('surname','<span class="help-block">:message</span> ') !!}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">@lang('Date of birth')</label>
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="@lang('Date of birth')" value="{{ $user->date_of_birth }}">
                    {!! $errors->first('date_of_birth','<span class="help-block">:message</span> ') !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="name">@lang('Sex')</label>
                    <input type="text" class="form-control" id="sex" name="sex" placeholder="@lang('Sex')" value="{{ $user->sex }}">
                    {!! $errors->first('sex','<span class="help-block">:message</span> ') !!}
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">@lang('Country')</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="@lang('Country')" value="{{ $user->country }}">
                    {!! $errors->first('country','<span class="help-block">:message</span> ') !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="name">@lang('About')</label>
                    <input type="text" class="form-control" id="about" name="about" placeholder="@lang('About')" value="{{ $user->about }}">
                    {!! $errors->first('about','<span class="help-block">:message</span> ') !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Check me out
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
@endsection