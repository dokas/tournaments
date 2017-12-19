@foreach($tournaments as $item)
    <tr>
        <td>{{ $item->title }}</td>
        <td><img src="" alt=""></td>
        <td>
            <input type="checkbox" name="status" value="{{ $item->id }}" {{ $item->active ? 'checked' : ''}}>
        </td>
        <td>{{ $item->created_at->formatLocalized('%c') }}</td>
        <td>
            <input type="checkbox" name="seen" value="{{ $item->id }}" {{ is_null($item->ingoing) ?  'disabled' : 'checked'}}>
        </td>
        <td>{{ $item->seo_title }}</td>
        <td><a class="btn btn-success btn-xs btn-block" href="{{ route('tournaments.show', [$item->id]) }}" role="button" title="@lang('Show')"><span class="fa fa-eye"></span></a></td>
        <td><a class="btn btn-warning btn-xs btn-block" href="{{ route('tournaments.edit', [$item->id]) }}" role="button" title="@lang('Edit')"><span class="fa fa-edit"></span></a></td>
        <td><a class="btn btn-danger btn-xs btn-block" href="{{ route('tournaments.destroy', [$item->id]) }}" role="button" title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
    </tr>
@endforeach

