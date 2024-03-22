<!-- Login Form -->
<form id="signin_form" action="#" method="post">
	<h3 class="d-block d-sm-none text-center mb-5">LOGIN<br>APLIKASI</h3>
    <input type="hidden" name="type" value="login" />
    {{-- <input type="hidden" name="instrumen" value="{{ $instrumen }}" /> --}}
    <input class="form-control" type="email" id="login_email" name="email" placeholder="Email" required />
    <input class="form-control" type="hp" id="login_hp" name="hp" placeholder="Nomor Hp" required />

	<a class="btn btn-lg btn-block btn-success btn-login" href="#">
		<i class="fa fa-sign-in"></i> Login
	</a>
	<a class="btn btn-lg btn-block btn-secondary btn-back" href="#">&longleftarrow; Kembali</a>
</form>
