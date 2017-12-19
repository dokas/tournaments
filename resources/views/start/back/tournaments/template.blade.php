@extends(env('THEME').'.back.layout')

@section('css')
    <style>
        textarea { resize: vertical; }
    </style>
    <link href="{{ asset(env('THEME').'/back/css/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
@endsection

@section('main')

    @yield('form-open')
    {{ csrf_field() }}

    <div class="row">

        <div class="col-md-8">
            @if (session('post-ok'))
                @component(env('THEME').'.back.components.alert')
                @slot('type')
                success
                @endslot
                {!! session('post-ok') !!}
                @endcomponent
            @endif
            @include(env('THEME').'.back.partials.boxinput', [
                'box' => [
                    'type' => 'box-primary',
                    'title' => __('Title'),
                ],
                'input' => [
                    'name' => 'title',
                    'value' => isset($tournament) ? $tournament->title : '',
                    'input' => 'text',
                    'required' => true,
                ],
            ])
            @include(env('THEME').'.back.partials.boxinput', [
                'box' => [
                    'type' => 'box-primary',
                    'title' => __('Slug'),
                ],
                'input' => [
                    'name' => 'slug',
                    'value' => isset($tournament) ? $tournament->slug : '',
                    'input' => 'text',
                    'required' => true,
                ],
            ])
            @include(env('THEME').'.back.partials.boxinput', [
                'box' => [
                    'type' => 'box-primary',
                    'title' => __('Description'),
                ],
                'input' => [
                    'name' => 'description',
                    'value' => isset($tournament) ? $tournament->description : '',
                    'input' => 'textarea',
                    'rows' => 10,
                    'required' => true,
                ],
            ])
            <button type="submit" class="btn btn-primary">@lang('Submit')</button>
        </div>

        <div class="col-md-4">
            @component(env('THEME').'.back.components.box')
            @slot('type')
            success
            @endslot
            @slot('boxTitle')
            @lang('Details')
            @endslot
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'game',
                    'values' => isset($tournament) ? $tournament->games : collect(),
                    'input' => 'select',
                    'title' => __('Game'),
                    'required' => true,
                ],
                'categories' => $games,
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'start_time',
                    'value' => isset($tournament) ? date('d.m.Y', $tournament->start_time) : '',
                    'input' => 'text',
                    'title' => __('Start time'),
                    'required' => true,
                ],
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'participants_amount',
                    'value' => isset($tournament) ? $tournament->participants_amount : '',
                    'input' => 'text',
                    'title' => __('Amount of participants'),
                    'required' => true,
                ],
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'fee',
                    'value' => isset($tournament) ? $tournament->fee : '',
                    'input' => 'text',
                    'title' => __('Fee'),
                    'required' => true,
                ],
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'prize',
                    'value' => isset($tournament) ? $tournament->prize : '',
                    'input' => 'text',
                    'title' => __('Prize'),
                    'required' => true,
                ],
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'active',
                    'value' => isset($tournament) ? $tournament->active : false,
                    'input' => 'checkbox',
                    'title' => __('Status'),
                    'label' => __('Active'),
                ],
            ])
            @endcomponent

            @component(env('THEME').'.back.components.box')
            @slot('type')
            primary
            @endslot
            @slot('boxTitle')
            @lang('Image')
            @endslot
            <img id="img" src="@isset($tournament) {{ $tournament->image }} @endisset" alt="" class="img-responsive">
            @slot('footer')
            <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
                <div class="input-group">
                    <div class="input-group-btn">
                        <a href="" class="popup_selector btn btn-primary" data-inputid="image">@lang('Select an image')</a>
                    </div>
                    <!-- /btn-group -->
                    <input class="form-control" type="text" id="image" name="image" value="{{ old('image', isset($tournament) ? $tournament->image : '') }}">
                </div>
                {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
            </div>
            @endslot
            @endcomponent

            @component(env('THEME').'.back.components.box')
            @slot('type')
            info
            @endslot
            @slot('boxTitle')
            SEO
            @endslot
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'meta_description',
                    'value' => isset($tournament) ? $tournament->meta_description : '',
                    'input' => 'text',
                    'title' => __('META Description'),
                    'input' => 'textarea',
                    'rows' => 3,
                    'required' => false,
                ]
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'meta_keywords',
                    'value' => isset($tournament) ? $tournament->meta_keywords : '',
                    'input' => 'text',
                    'title' => __('META Keywords'),
                    'input' => 'textarea',
                    'rows' => 3,
                    'required' => false,
                ]
            ])
            @include(env('THEME').'.back.partials.input', [
                'input' => [
                    'name' => 'seo_title',
                    'value' => isset($tournament) ? $tournament->seo_title : '',
                    'input' => 'text',
                    'title' => __('SEO Title'),
                    'required' => false,
                ],
            ])
            @endcomponent

        </div>
    </div>
    <!-- /.row -->
    </form>

@endsection

@section('js')

    <script src="{{ asset(env('THEME').'/back/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
    <script src="{{ asset(env('THEME').'/back/plugins/voca/voca.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace('description', {customConfig: '/{{ env('THEME') }}/back/js/ckeditor.js'})

        $('.popup_selector').click( function (event) {
            event.preventDefault()
            var updateID = $(this).attr('data-inputid')
            var elfinderUrl = '/elfinder/popup/'
            var triggerUrl = elfinderUrl + updateID
            $.colorbox({
                href: triggerUrl,
                fastIframe: true,
                iframe: true,
                width: '70%',
                height: '70%'
            })
        })

        function processSelectedFile(filePath, requestingField) {
            $('#' + requestingField).val('\\' + filePath)
            $('#img').attr('src', '\\' + filePath)
        }

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

@endsection