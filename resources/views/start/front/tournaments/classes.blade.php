@extends(env('THEME').'.front.tournaments.tournament')

@section('section')
    @foreach($tournament->heroClasses as $heroClass)
    <div class="col-md-4">
        <a href="javascript:void(0)" class="hero-class-item @if($currentParticipant->hero_classes->contains($heroClass->id)) active @endif " data-id="{{ $heroClass->id }}">
            <img src="/files/classes/{{ $heroClass->image }}" alt="{{ $heroClass->name }}" />
        </a>
    </div>
    @endforeach
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('.hero-class-item').click(function() {
                var $$ = $(this),
                    id = $$.data('id');
                $.ajax({
                    url: '{{ url('tournaments/participants/add-hero-class/'.$currentParticipant->id) }}/'+id,
                    type: 'post',
                    success: function(response) {
                        if(response.status) {
                            $$.toggleClass('active');
                        }

                    }
                });
                return false;
            });
        });
    </script>
@endsection