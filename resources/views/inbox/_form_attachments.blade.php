@php $ao = $data->attachments_order ?? null; @endphp
<div class="row">
    @foreach (range(1, 4) as $index)
        @if ($index == 1) @php $color = 'primary' @endphp
        @elseif ($index == 2) @php $color = 'info' @endphp
        @elseif ($index == 3) @php $color = 'warning' @endphp
        @elseif ($index == 4) @php $color = 'danger' @endphp
        @endif

        <div class="col-3 m-0">
            @if ($ao !== null)
                <label class="btn btn-block btn-{{ $color }} btn-file" data-item="{{ $index }}">
                    <span><i class="fa fa-{{ $ao[$index] !== null ? 'check' : 'upload' }}"></i> {{ str_limit($ao[$index]['title'] ?? 'Lampiran #'.$index, 18) }}</span>
                    @if ($ao[$index] ?? null !== null)
                        <input type="hidden" name="uploaded_file[{{ $ao[$index]['id'] }}]" value="current">
                    @endif
                    <input type="file" style="display: none;" accept="application/pdf, image/*" name="attachment[{{ $index }}]" id="attachment_{{ $index }}" data-status="{{ $ao[$index] !== null ? 'edited' : 'new' }}">
                </label>
            @else
                <label class="btn btn-block btn-{{ $color }} btn-file" data-item="{{ $index }}">
                    <span><i class="fa fa-upload"></i> Lampiran #{{ $index }}</span>
                    <input type="file" style="display: none;" accept="application/pdf, image/*" name="attachment[{{ $index }}]" id="attachment_{{ $index }}" data-status="new">
                </label>
            @endif
            @if ($ao[$index] ?? null !== null)
                <div>
                    <a href="{{ url('storage/'. $ao[$index]['name']) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Lampiran</a>
                    <a href="#" class="btn btn-sm btn-outline-danger float-right delete-attachment">Hapus</a>
                </div>
            @endif
        </div>
    @endforeach
</div>
