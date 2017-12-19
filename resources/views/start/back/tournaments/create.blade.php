@extends(env('THEME').'.back.tournaments.template')

@section('form-open')
    <form method="post" action="{{ route('tournaments.store') }}">
@endsection