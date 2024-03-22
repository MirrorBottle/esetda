@foreach ($forwards as $forward)
    <tr
        data-id="{{ $forward->id }}"
        data-date="{{ $forward->inbox->date ?? '' }}"
        data-no="{{ $forward->inbox->no ?? '' }}"
        data-sender="{{ $forward->inbox->sender ?? '' }}"
        data-description="{{ $forward->inbox->title ?? '-' }}"
        data-biro="{{ $forward->inbox->biro_id ?? '-' }}"
        >
        <td data-order="{{ $loop->iteration }}">
            @if ($forward->is_received == 1)
                &nbsp;<i class="fa fa-check-circle text-success" data-toggle="tooltip" data-placement="top" title="Sudah Terima"></i>
            @else
                &nbsp;<i class="fa fa-sync text-info" data-toggle="tooltip" data-placement="top" title="Belum Terima"></i>
            @endif
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>Surat {{ ucfirst($forward->type_indo) }}</td>
        <td>{{ $forward->inbox->biro->name ?? $forward->outbox->biro->name }}</td>
        <td style="max-width: 140px;">{{ $forward->inbox->no ?? $forward->outbox->no }}</td>
        <td>
            <span data-date="{{ $forward->inbox->date ?? $forward->outbox->date }}">
                {{ $forward->inbox->date_formatted ?? $forward->outbox->date_formatted }}
            </span>
        </td>
        <td>
            <span data-date="{{ $forward->inbox->date_entry ?? $forward->outbox->date_entry }}">
                {{ $forward->inbox->date_entry_formatted ?? $forward->outbox->date_entry_formatted  }}
            </span>
        </td>
        <td>
            <div class="dropdown">
                <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                    @if ($forward->is_received == 0)
                        <a href="{{ url('/surat-terusan/terima/'. $forward->id) }}" class="text-left btn btn-sm btn-success btn-block mb-1">
                            <i class="fa fa-check"></i> Terima surat
                        </a>
                    @endif
                    <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $forward->inbox->id ?? $forward->outbox->id }}" data-type="{{ $forward->type }}">
                        <i class="fa fa-eye"></i> Detail surat
                    </a>
                    <a href="#" class="text-left btn btn-sm btn-warning btn-block btn-duplikat mb-1" data-toggle="modal" data-target="#duplikasi-modal" data-id="{{ $forward->inbox->id ?? $forward->outbox->id }}" data-type="{{ $forward->type }}">
                        <i class="fa fa-copy"></i> Duplikasi Surat
                    </a>
                    <a href="#" class="text-left btn btn-sm btn-primary btn-block btn-lampiran mb-1" data-toggle="modal" data-target="#lampiran-modal" data-id="{{ $forward->inbox->id ?? $forward->outbox->id }}" data-type="{{ $forward->type }}">
                        <i class="fa fa-file-alt"></i> Tambah Lampiran
                    </a>
                    <a href="#" class="text-left btn btn-sm btn-success btn-block btn-keterangan mb-1" data-toggle="modal" data-target="#keterangan-modal" data-id="{{ $forward->inbox->id ?? $forward->outbox->id }}" data-type="{{ $forward->type }}" data-note="{{ $forward->note_description }}">
                        <i class="fa fa-comment"></i> Tambah Keterangan
                    </a>
                    @if ($forward->type == 'inbox')
                        <a href="#" class="text-left btn btn-sm btn-warning btn-block btn-disposisi mb-1" data-toggle="modal" data-target="#disposisi-modal" data-id="{{ $forward->inbox->id }}">
                            <i class="fa fa-print"></i> Lembar Disposisi
                        </a>
                    @endif
                </div>
            </div>
        </td>
    </tr>
@endforeach
