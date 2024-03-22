<div class="card shadow">
    <div class="card-header bg-secondary border-0">
        <div class="row align-items-center">
            <div class="col-8">
                <h3 class="mb-0">Data Penerima</h3>
            </div>
            <div class="col-4 text-right">
            </div>
        </div>
    </div>
    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="datatable">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Penerima</th>
                        <th scope="col">Nomor WA</th>
                        <th scope="col">Nama Instansi</th>
                        <th scope="col">Kepala Instansi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phones as $phone)
                        <tr data-id="{{ $phone->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $phone->name }}</td>
                            <td>{{ $phone->wa }}</td>
                            <td>{{ $phone->institution }}</td>
                            <td>{{ $phone->institution_head }}</td>
                            <td style="width: 70px;">
                                <a href="@" class="btn btn-sm btn-info btn-edit-phone" data-toggle="modal" data-target="#phone-modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-delete-phone">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
