@foreach ($archives as $archive)
    <tr data-checked="false" data-id="{{ $archive->id }}">
        <td>
            @if ($archive->status == 'p')
                @if (auth()->user()->isAdmin())
                    <input type="checkbox" class="checkbox" value="{{ $archive->id }}">
                @else
                    <i class="fa fa-sync text-info" data-toggle="tooltip" title="Sedang Proses"></i>
                @endif
            @elseif ($archive->status == 'a')
                <i class="fa fa-check-circle text-green" data-toggle="tooltip" title="Terverifikasi"></i>
            @elseif ($archive->status == 'r')
                <i class="fa fa-times-circle text-danger" data-toggle="tooltip" title="Ditolak"></i>
            @else
                <input type="checkbox" class="checkbox" value="{{ $archive->id }}">
            @endif
        </td>
        <td>{{ $loop->iteration }}</td>
        @if (auth()->user()->isAdmin())
            <td>{{ $archive->biro->alias }}</td>
        @endif
        <td>{{ $archive->date_formatted }}</td>
        <td>{{ $archive->archivable->no }}</td>
        <td>{{ $archive->archivable->title }}</td>
        <td>{{ $archive->year }}</td>
        <td>
            <span class="badge badge-{{ $archive->condition == 1 ? 'success' : 'danger' }}">
                {{ $archive->condition_formatted }}
            </span>
        </td>
        <td>
            <div class="dropdown">
                <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                    @if ($archive->status == 'r' && !auth()->user()->isAdmin())
                        <a href="#" class="text-left btn btn-sm btn-default btn-block btn-retry mb-1" data-toggle="modal" data-target="#validate-modal" data-id="{{ $archive->id }}">
                            <i class="fa fa-sync"></i> Kirim ulang arsip
                        </a>
                    @endif
                    <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $archive->id }}">
                        <i class="fa fa-external-link-alt"></i> Detail arsip
                    </a>
                    <a href="{{ url('/arsip/'. $type .'/'. $archive->id) .'/edit' }}" class="btn-block text-left btn btn-sm btn-warning btn-edit mb-1">
                        <i class="fa fa-edit"></i> Ubah arsip
                    </a>
                    @if ($archive->status !== 'a')
                        <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $archive->id }}" data-type="{{ $type }}">
                            <i class="fa fa-times"></i> Hapus arsip
                        </a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforeach
