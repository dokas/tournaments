@extends(env('THEME').'.back.tournaments.template')

@section('form-open')
    <form method="post" action="{{ route('tournaments.update', $tournament->id) }}">
        {{ method_field('PUT') }}
@endsection