@foreach ($visitors as $visitor)
    <tr data-title="{{ $visitor->letter_title }}" data-description="{{ $visitor->description }}" data-attachment="{{ $visitor->attachment->name ?? '' }}">
        <td>
            @if ($visitor->status === 'P')
                <i class="fa fa-check-circle text-success" data-toggle="tooltip" data-placement="top" title="Sudah Validasi"></i>
            @elseif ($visitor->status === 'T')
                <i class="fa fa-times-circle text-danger" data-toggle="tooltip" data-placement="top" title="Ditolak"></i>
            @elseif ($visitor->status === 'B')
                <i class="fa fa-sync text-light" data-toggle="tooltip" data-placement="top" title="Belum Validasi"></i>
            @endif
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $visitor->letter_no }}</td>
        {{-- <td>{{ $visitor->letter_title }}</td> --}}
        <td>{{ $visitor->sender }}</td>
        <td>{{ $visitor->institution }}</td>
        <td>{{ $visitor->receiver->name }}</td>
        <td>{{ $visitor->date }}</td>
        <td>
            @if ($visitor->status === 1)
                <a class="btn btn-sm btn-info btn-detail text-white" data-toggle="modal" data-target="#detail-modal" data-id="{{ $visitor->id }}">
                    Detail
                </a>
            @else
                <div class="dropdown">
                    <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                        <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $visitor->id }}">
                            <i class="fa fa-check"></i> Detail surat
                        </a>
                        @if ($visitor->status === 'B')
                            <a href="#" class="text-left btn btn-sm btn-default btn-block btn-forward mb-1" data-toggle="modal" data-target="#forward-modal" data-id="{{ $visitor->id }}" data-receiver="{{ $visitor->receiver_id }}">
                                <i class="fa fa-share"></i> Terusakan surat
                            </a>
                            <a href="#" class="text-left btn btn-sm btn-warning btn-block btn-invalid mb-1" data-toggle="modal" data-target="#invalid-modal" data-id="{{ $visitor->id }}">
                                <i class="fa fa-times"></i> Tolak surat
                            </a>
                        @endif
                        {{-- <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $visitor->id }}">
                            <i class="fa fa-trash"></i>&nbsp; Hapus surat
                        </a> --}}
                    </div>
                </div>
            @endif
        </td>
    </tr>
@endforeach
