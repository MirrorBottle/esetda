<div class="row mb-3">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3 class="mb-0">Filter Data Surat</h3>
                    </div>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="" method="GET" class="row d-flex align-items-center">
                    <div class="col-12 col-md-5">
                        <label for="input_type" class="mr-3"><small class="font-weight-bold">Tipe</small></label>
                        <div class="switch-button" style="display: inline-block;">
                            @if ($type == 'masuk')
                                <a href="#" class="btn btn-success masuk">
                                    <i class="fa fa-check"></i>
                                    Surat Masuk
                                </a>
                                <a href="#" class="btn btn-secondary keluar">
                                    Surat Keluar
                                </a>
                            @else
                                <a href="#" class="btn btn-secondary masuk">
                                    Surat Masuk
                                </a>
                                <a href="#" class="btn btn-success keluar">
                                    <i class="fa fa-check"></i>
                                    Surat Keluar
                                </a>
                            @endif
                        </div>
                        <input type="hidden" name="type" id="input_type" value="{{ $type }}">
                    </div>
                    <div class="col-12 col-md-5 pl-0">
                        <label for="input_biro" class="mr-3"><small class="font-weight-bold">Biro</small></label>
                        <select name="biro_id" id="input_biro" class="form-control" style="display: inline-block; width: 85%;">
                            <option value="">-- Seluruh Biro --</option>
                            @foreach ($biros as $id => $name)
                                <option value="{{ $id }}" {{ request()->biro_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" href="#" class="btn btn-primary">
                            <i class="fa fa-search"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
