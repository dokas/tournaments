@extends(env('THEME').'.back.layout')

@section('main')
    @admin
        <div class="row">
            @each(env('THEME').'/back/partials/panel', $panels, 'panel')
        </div>
    @endadmin
@endsection
