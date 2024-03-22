<div class="card mb-4 shadow">
    <div class="card-header bg-secondary border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Lampiran #{{ $index }}</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if ($attachments[$index] == null)
            <p>Tidak ada lampiran</p>
        @else
            <a href="{{ asset('storage/'. $attachments[$index]['name']) }}" target="blank" class="btn btn-primary mb-2">
                <i class="fa fa-download"></i> Unduh Lampiran #{{ $index }}
            </a>
            <p>Judul Asli : <b>{{ $attachments[$index]['title'] }}</b></p>
            <div>
                @if ($attachments[$index]['is_pdf'])
                    <iframe id="pdf-viewer" data-source="{{ asset('storage/'. $attachments[$index]['name']) }}" style="width:100%; height:800px;" frameborder="0"></iframe>
                @else
                    <img src="{{ asset('storage/'. $attachments[$index]['name']) }}" alt="lampiran" class="img-thumbnail" style="width: 50%;">
                @endif
            </div>
        @endif
    </div>
</div>

@push('js')
<script>
    $(function() {
        const pdfFile = $('#pdf-viewer').attr('data-source');
        $('#pdf-viewer').attr('src', pdfFile + '#page=1&zoom=100');
    });
</script>
@endpush
