<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-{{ $panel->color }}">
        <div class="inner">
            <h3>{{ $panel->nbr }}</h3>

            <p>{{ $panel->name }}</p>
        </div>
        <div class="icon">
            <span class="fa fa-{{ $panel->icon }}"></span>
        </div>
        <a href="{{ $panel->url }}" class="small-box-footer">
            @lang('More info') <span class="fa fa-arrow-circle-right"></span>
        </a>
    </div>
</div>