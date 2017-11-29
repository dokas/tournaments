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
                    {{ $news->id }}
                    <hr>
                    <p>@lang('Title')</p>
                    {{ $news->title }}
                    <hr>
                    <p>@lang('Excerpt')</p>
                    {{ $news->description }}
                    <hr>
                    <p>@lang('Slug')</p>
                    {{ $news->alias }}
                    <hr>
                    <p>@lang('Status')</p>
                    {{ $news->active ? __('Active') : __('No Active')}}
                    <hr>
                    <p>@lang('Date Creation')</p>
                    {{ $news->created_at->formatLocalized('%c') }}
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