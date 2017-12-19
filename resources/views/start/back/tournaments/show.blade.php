@extends(env('THEME').'.back.layout')

@section('css')
    <style>
        .box-body hr+p {
            font-size: x-large;
        }
    </style>
@endsection


@section('main')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <hr>
                    <p>ID</p>
                    {{ $tournament->id }}
                    <hr>
                    <p>@lang('Title')</p>
                    {{ $tournament->title }}
                    <hr>
                    <p>@lang('Author')</p>
                    {{ $tournament->user->name }}
                    <hr>
                    <p>@lang('Description')</p>
                    {{ $tournament->description }}
                    <hr>
                    <p>@lang('Image')</p>
                    <img src="{{ $tournament->img }}" alt="" width="200px">
                    <hr>
                    <p>@lang('Slug')</p>
                    {{ $tournament->slug }}
                    <hr>
                    <p>@lang('SEO Title')</p>
                    {{ $tournament->seo_title }}
                    <hr>
                    <p>@lang('META Description')</p>
                    {{ $tournament->meta_description }}
                    <hr>
                    <p>@lang('META Keywords')</p>
                    {{ $tournament->meta_keywords }}
                    <hr>
                    <p>@lang('Status')</p>
                    {{ $tournament->active ? __('Active') : __('No Active')}}
                    <hr>
                    <p>@lang('Date Creation')</p>
                    {{ $tournament->created_at->formatLocalized('%c') }}
                    <hr>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection