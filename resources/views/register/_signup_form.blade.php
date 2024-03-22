{{-- Register form --}}
<form id="signup_form" action="" method="post">
    @csrf

	<h3 class="d-block d-sm-none text-center" style="margin-top: 16rem; margin-bottom: 6rem">REGISTRASI<br>PARTISIPAN</h3>
    <input type="hidden" name="type" value="register" required />
    {{-- <input type="hidden" id="instrumen" name="instrumen" value="1" required /> --}}
    <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama Lengkap" required />
    <input class="form-control d-none" type="email" id="email" name="email" placeholder="Email" />
    <input class="form-control d-none" type="text" id="hp" name="no_hp" placeholder="No. HP" />
    <select style="margin: 8px 0;" class="form-control"  name="kelamin" required>
        <option value="1">Laki-laki</option>
        <option value="0">Prempuan</option>
    </select>
    <input class="form-control" type="number" style="width: 35%;" id="usia" name="usia" placeholder="Usia" />
    <select style="margin: 8px 0;" class="form-control" id="pendidikan"  name="pendidikan" required>
        <option value="">Pendidikan yang ditempuh</option>
        <option value="1">S1</option>
        <option value="2">S2</option>
        <option value="3">S3</option>
    </select>
    <select style="margin: 8px 0;" class="form-control" id="jabatan"  name="jabatan" required>
        <option value="">Jabatan</option>
        <option value="1">Staf</option>
        <option value="2">Kepala</option>
    </select>
    <select style="margin: 8px 0;" class="form-control" id="jenis_pekerjaan"  name="jenis_pekerjaan" required>
        <option value="">Jenis Pekerjaan</option>
        <option value="1">Auditor</option>
        <option value="2">Non Auditor</option>
    </select>
    <!-- <input class="form-control" type="text" id="pendidikan" name="pendidikan" placeholder="Pendidikan yang ditempuh" /> -->
    <!-- <input class="form-control" type="text" id="jabatan" name="jabatan" placeholder="Jabatan" /> -->
    <!-- <input class="form-control" type="text" id="jenis_pekerjaan" name="jenis_pekerjaan" placeholder="Jenis pekerjaan" /> -->
    <input class="form-control" type="text" id="masa_kerja" name="masa_kerja" placeholder="Masa Kerja" required />
    <input class="form-control" type="text" id="instansi" name="instansi" placeholder="Instansi" required />
    <a class="btn btn-lg btn-block btn-success btn-save" href="#">
		<i class="fa fa-check"></i>	Registrasi Data
	</a>
    <a class="btn btn-lg btn-block btn-secondary btn-back" href="#">&longleftarrow; Kembali</a>
</form>
