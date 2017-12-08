@extends(env('THEME').'.front.user.template')

@section('profile-body')
    <div class="col-md-4">
        image
    </div>
    <div class="col-md-8">
        <div class="panel-heading">{{ $user->login }}</div>
        <div class="row form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="bg-light p-3">
                        <div><small>@lang('Name')</small></div>
                        <div><strong>{{ $user->name }}</strong></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3">
                        <div><small>@lang('Last name')</small></div>
                        <div><strong>{{ $user->surname }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="bg-light p-3">
                        <div><small>@lang('Date fo birth')</small></div>
                        <div><strong>{{ $user->date_of_birth }}</strong></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3">
                        <div><small>@lang('Sex')</small></div>
                        <div><strong>{{ $user->sex }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="bg-light p-3">
                <div><small>@lang('Country')</small></div>
                <div><strong>{{ $user->country }}</strong></div>
            </div>
        </div>
        <div class="row form-group">
            <div class="bg-light p-3">
                <div><small>@lang('About me')</small></div>
                <div><strong>{{ $user->about }}</strong></div>
            </div>
        </div>
    </div>
@endsection