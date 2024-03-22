<div class="header bg-gradient-primary pt-6 pb-6" style="min-height: 100vh;">
    <div class="container-fluid">
        {{-- archive info --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow mt-4">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Agenda Hari Ini</h3>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 30px;">No</th>
                                    @if (auth()->user()->isAdmin())
                                        <th scope="col" style="width: 350px;">Yang Menghadiri</th>
                                    @endif
                                    <th scope="col" style="width: 150px;">Jam Kegiatan</th>
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">Tempat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['agendas'] as $agenda)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @if (auth()->user()->isAdmin())
                                            <td>{{ $agenda->receiver->name }}</td>
                                        @endif
                                        <td>{{ $agenda->time_start == null ? '-' : $agenda->time_start .' s/d ' . $agenda->time_end }}</span>
                                        </td>
                                        <td>{{ $agenda->event }}</td>
                                        <td>{{ $agenda->place->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Tidak ada data terkait</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
