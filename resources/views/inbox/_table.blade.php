@foreach ($inboxes as $inbox)
    @php $disposition_first = $inbox->disposition_first($user_id); @endphp
    <tr>
        <td data-order="{{ $loop->iteration }}" data-checked="false" data-id="{{ $inbox->id }}">
            @if ($inbox->is_archived === null && $is_super === false)
                <input type="checkbox" class="checkbox" value="{{ $inbox->id }}">
            @elseif ($inbox->is_archived === 0)
                <i class="fa fa-sync text-info" data-toggle="tooltip" data-placement="top" title="Proses Arsip"></i>
            @elseif ($inbox->is_archived === 1)
                <i class="fa fa-check-circle text-success" data-toggle="tooltip" data-placement="top" title="Sudah Arsip"></i>
            @endif

            @if ($inbox->reference_id !== null && (strpos(auth()->user()->username, 'karo') === false))
                <i class="fa fa-copy text-warning" data-toggle="tooltip" data-placement="top" title="Surat Duplikasi"></i>
            @endif

            @if ($inbox->is_forwarded === 1)
                <i class="fa fa-share-square text-danger" data-toggle="tooltip" data-placement="top" title="Diteruskan"></i>
            @endif

            @if ($inbox->is_agenda === 1)
                <i class="fa fa-calendar text-warning" data-toggle="tooltip" data-placement="top" title="Menjadi Agenda"></i>
            @endif

            @if ($is_super)
                @if ($inbox->visitor_id !== NULL)
                    <i class="fa fa-user text-info" data-toggle="tooltip" data-placement="top" title="Dari Surat Tamu"></i>
                @endif
            @endif
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $inbox->no }}</td>
        <td>{{ $inbox->title }}</td>
        <td>{{ $inbox->sender }}</td>
        @if (auth()->user()->biro_id == 1)
            <td data-id="{{ $inbox->receiver_id }}">{{ $inbox->receiver->name }}</td>
        @endif
        <td>
            @if (($disposition_first->receiver->name ?? '-') == 'ARSIP')
                ARSIP {{ $disposition_first->user->receiver->name }}
            @else
                {{ $disposition_first->receiver->name ?? '-' }} {{ $disposition_first->position ?? '' }}
            @endif
        </td>
        <td>
            @if (($disposition_first->receiver->name ?? null) === NULL)
                <span class="badge badge-danger" style="line-height: 1.4;">Belum<br>Disposisi</span>
            @else
                <span class="badge badge-success" style="line-height: 1.4;">Sudah<br>Disposisi</span>
            @endif
        </td>
        <td>
            <span class="badge badge-calendar badge-pill badge-danger mb-1" data-date="{{ $inbox->date }}">
                <i class="fa fa-calendar"></i> {{ $inbox->date_formatted }}
            </span>
            <span class="badge badge-calendar badge-pill badge-primary" data-date="{{ $inbox->date_entry }}">
                <i class="fa fa-calendar-check"></i> {{ $inbox->date_entry_formatted }}
            </span>
        </td>
        <td>
            @if ($is_super)
                <div class="dropdown">
                    <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                        <a href="#" class="text-left btn btn-sm btn-block btn-info btn-detail mb-1 mr-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $inbox->id }}">
                            <i class="fa fa-check"></i> Detail
                        </a>
                        <a href="{{ url('disposisi-admin/'. $inbox->id) }}" class="text-left btn btn-sm btn-block btn-success btn-disposisi-admin mb-1">
                            <i class="fa fa-edit"></i> Disposisi
                        </a>
                        @if (($disposition_first->receiver->name ?? '-') !== 'ARSIP')
                            @if (auth()->user()->biro_id === NULL)
                                <a href="{{ url('disposisi-admin/print/'. $inbox->id) }}" target="_blank" class="text-left btn btn-sm btn-block btn-warning btn-disposisi-cetak mb-1">
                                    <i class="fa fa-print"></i> Cetak
                                </a>
                            @else
                                @if (auth()->user()->biro_id == $inbox->biro_id)
                                    <a href="{{ url('disposisi-admin/print/'. $inbox->id) }}" target="_blank" class="text-left btn btn-sm btn-block btn-warning btn-disposisi-cetak mb-1">
                                        <i class="fa fa-print"></i> Cetak
                                    </a>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            @else
                <div class="dropdown">
                    <a class="btn btn-sm btn-secondary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-2">
                        <a href="#" class="text-left btn btn-sm btn-success btn-block btn-disposisi mb-1" data-toggle="modal" data-target="#disposisi-modal" data-id="{{ $inbox->id }}">
                            <i class="fa fa-print"></i> Lembar Disposisi
                        </a>
                        @if (auth()->user()->biro_id === NULL)
                            <a href="{{ url('disposisi-admin/print/'. $inbox->id) }}" target="_blank" class="text-left btn btn-sm btn-block btn-warning btn-disposisi-cetak mb-1">
                                <i class="fa fa-print"></i> Cetak Disposisi Baru
                            </a>
                        @else
                            @if (auth()->user()->biro_id == $inbox->biro_id)
                                <a href="{{ url('disposisi-admin/print/'. $inbox->id) }}" target="_blank" class="text-left btn btn-sm btn-block btn-warning btn-disposisi-cetak mb-1">
                                    <i class="fa fa-print"></i> Cetak Disposisi Baru
                                </a>
                            @endif
                        @endif
                        <a href="#" class="text-left btn btn-sm btn-info btn-block btn-detail mb-1" data-toggle="modal" data-target="#detail-modal" data-id="{{ $inbox->id }}">
                            <i class="fa fa-check"></i> Detail surat
                        </a>
                        <a href="{{ url('/surat-masuk/'. $inbox->id) .'/edit' }}" class="btn-block text-left btn btn-sm btn-primary btn-edit mb-1">
                            <i class="fa fa-edit"></i> Ubah surat
                        </a>
                        <a href="#" class="text-left btn btn-sm btn-default btn-block btn-forward mb-1" data-toggle="modal" data-target="#forward-modal" data-id="{{ $inbox->id }}" data-type="inbox">
                            <i class="fa fa-share"></i> Terusakan surat
                        </a>
                        @if ($inbox->is_archived === null && (auth()->user()->biro_id == 1 || auth()->user()->biro_id == 6) && $inbox->is_agenda == 0)
                            <a href="{{ url('surat-agenda/'. $inbox->id) }}" class="text-left btn btn-sm btn-success btn-block btn-archive mb-1">
                                <i class="fa fa-calendar"></i>&nbsp; Jadikan agenda
                            </a>
                        @endif
                        @if (auth()->user()->biro_id == 1)
                            <a href="#" data-toggle="modal" data-target="#receipt-modal" data-id="{{ $inbox->id }}" data-type="inbox" class="text-left btn btn-sm btn-dark btn-block btn-receipt mb-1">
                                <i class="fa fa-upload"></i> Upload Tanda Terima
                            </a>
                        @endif
                        <a href="#" class="text-left btn btn-sm btn-danger btn-block btn-delete mb-1" data-id="{{ $inbox->id }}">
                            <i class="fa fa-times"></i>&nbsp; Hapus surat
                        </a>
                    </div>
                </div>
            @endif
        </td>
    </tr>
@endforeach
