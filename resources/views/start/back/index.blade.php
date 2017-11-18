@extends(env('THEME').'.back.layout')

@section('main')
{{ dump($pannels) }}
    @admin
        <div class="row">
            @each('back/partials/pannel', $pannels, 'pannel')
        </div>
    @endadmin
@endsection
