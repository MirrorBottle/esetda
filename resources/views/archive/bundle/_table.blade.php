@foreach ($details as $detail)
    <tr data-checked="false" data-id="{{ $detail->archive->id }}">
        <td>
            @if ($detail->archive->status == 'a')
                <i class="fa fa-check-circle text-green" data-toggle="tooltip" title="Terverifikasi"></i>
            @elseif ($detail->archive->status == 'r')
                <i class="fa fa-times-circle text-danger" data-toggle="tooltip" title="Ditolak"></i>
            @else
                <input type="checkbox" class="checkbox" value="{{ $detail->archive->id }}">
            @endif
        </td>
        <td>{{ $loop->iteration }}</td>
        @if (auth()->user()->isAdmin())
            <td>{{ $detail->archive->biro->alias }}</td>
        @endif
        <td>{{ $detail->archive->date_formatted }}</td>
        <td>{{ $detail->archive->archivable->no }}</td>
        <td>{{ $detail->archive->archivable->title }}</td>
        <td>{{ $detail->archive->year }}</td>
        <td>
            <span class="badge badge-{{ $detail->archive->condition == 1 ? 'success' : 'danger' }}">
                {{ $detail->archive->condition_formatted }}
            </span>
        </td>
        <td>
            <div class="dropdown">
                <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                    @if ($detail->archive->status == 'r')
                        <a href="#" class="text-left btn btn-sm btn-default btn-block btn-retry mb-1" data-toggle="modal" data-target="#validate-modal" data-id="{{ $detail->archive->id }}">
                            <i class="fa fa-sync"></i> Kirim ulang arsip
                        </a>
                    @endif
                    <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $detail->archive->id }}">
                        <i class="fa fa-external-link-alt"></i> Detail arsip
                    </a>
                    <a href="{{ url('/arsip/'. $type .'/'. $detail->archive->id) .'/edit?back_url='. $back_url }}" class="btn-block text-left btn btn-sm btn-warning btn-edit mb-1">
                        <i class="fa fa-edit"></i> Ubah arsip
                    </a>
                    @if ($detail->archive->status !== 'a')
                        <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $detail->archive->id }}" data-type="{{ $type }}">
                            <i class="fa fa-times"></i> Hapus arsip
                        </a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforeach
