@extends(env('THEME').'.front.tournaments.tournament')

@section('section')
    @if(!count($participants))
        @lang('There is no participants')
    @else
        @foreach($participants as $participant)
        <div class="col-md-3">
            {{ $participant->user->name }}
            <br>
            @lang('Confirmed'): {{ $participant->confirmed }}
        </div>
        @endforeach
    @endif
@endsection