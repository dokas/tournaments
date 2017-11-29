@extends(env('THEME').'.back.news.template')

@section('form-open')
    <form method="post" action="{{ route('news.store') }}">
@endsection