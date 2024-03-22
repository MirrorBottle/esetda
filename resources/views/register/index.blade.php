@extends('layouts.app_slide')

@section('content')
	<section class="sldie current">
		<div class="container">
			<div class="row" >
				<div class="col-lg-6 col-sm-12 overlay-panel overlay-left">
					<img style="height: 200px" src="{{ url('images/content/registration.png') }}">
					<h3 class="info-title"></h3>
				</div>
				<div class="col-lg-6 col-sm-12 overlay-panel overlay-right">
					<div id="info-area">
						<h1>REGISTRASI PARTISIPAN</h1>
						<button class="btn btn-success custom-button mt-3" id="signUp">Klik Disini</button>

						<div class="login-button d-none">
							<h6>Sudah Memiliki Akun?</h6>
							<button class="btn btn-success custom-button mt-3" id="signIn">
								Login
							</button>
						</div>
					</div>
					@include('register._signin_form')
					@include('register._signup_form')
				</div>
			</div>
		</div>
	</section>
@endsection

@push('css')
	<style>
		#signin_form, #signup_form, .info-title {
			display: none;
		}

		.overlay-panel {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 40px;
			text-align: center;
			top: 0;
			height: 100%;
			width: 50%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}
		.overlay-right {
			right: 0;
			transform: translateX(0);
			background: #fff;
		}
		.overlay-left {
			transform: translateX(-17%);
			background: #00bd56;
			background: -webkit-gradient(linear,left top,right top,from(#0e9577),to(#00bd56)) no-repeat 0 0/cover;
			background: linear-gradient(90deg,#0e9577,#00bd56) no-repeat 0 0/cover;
			background-repeat: no-repeat;
			background-size: cover;
			background-position: 0 0;
			color: #FFFFFF;
		}

		.custom-button {
			font-size: 1.5rem;
		}

		.btn {
			border-radius: 100px;
    		padding: 1rem 3.2rem;
		}

		form {
			width: 80%;
		}

		.form-control {
			font-size: 1.6rem;
			margin-bottom: .5rem;
		}

		select.form-control {
			-webkit-box-shadow: 0 10px 16px -8px rgba(0, 20, 80, 0.3);
 		   box-shadow: 0 10px 16px -8px rgba(0, 20, 80, 0.3);
		}

		.btn-back, .btn-save, .btn-login {
			font-size: 1.8rem;
			margin-top: 1.5rem !important;
		}

		.login-button {
			position: absolute;
			bottom: 3.5rem;
			left: 35%;
		}

		@media (max-width: 576px) {
			.overlay-left {
				display: none;
			}
			.overlay-panel {
				width: 100%;
			}
			.overlay-right {
				background: #00bd56;
				background: -webkit-gradient(linear,left top,right top,from(#0e9577),to(#00bd56)) no-repeat 0 0/cover;
				background: linear-gradient(90deg,#0e9577,#00bd56) no-repeat 0 0/cover;
				background-repeat: no-repeat;
				background-size: cover;
				background-position: 0 0;
				color: #FFFFFF;
			}
			.overlay-right.custom {
				height: auto;
				padding-bottom: 10rem;
			}

			.btn {
				background: transparent;
				border-color: #fff;
				color: #fff;
			}

			form {
				width: 100%;
			}

			.login-button {
				left: 26%;
			}
		}
	</style>
@endpush

@push('js')
	<script>
		$(function() {
			const $mainArea = $('#info-area');
			const $title = $('.info-title');

			$('#signIn').click(function() {
				$mainArea.hide();
				$('#signin_form').fadeIn('slow');
				$title.fadeIn('slow');
				$title.text('LOGIN');
				$('#login_email').focus();
				$('.overlay-right').removeClass('custom');
			});

			$('#signUp').click(function() {
				$mainArea.hide();
				$('#signup_form').fadeIn('slow');
				$title.fadeIn('slow');
				$title.text('REGISTRASI PARTISIPAN');
				$('#nama').focus();
				$('.overlay-right').addClass('custom');
			});

			$('.btn-back').click(function(e) {
				e.preventDefault();
				$('#signup_form').hide();
				$('#signin_form').hide();
				$mainArea.fadeIn('slow');
				$title.hide('slow');
				$title.text('');
				$('.overlay-right').removeClass('custom');
			});

			$('.btn-save').click(function(e) {
                e.preventDefault();

                var nama = $('#nama').val().length;
                var usia = $('#usia').val().length;
                var pendidikan = $('#pendidikan').val().length;
                var jabatan = $('#jabatan').val().length;
                var jenis_pekerjaan = $('#jenis_pekerjaan').val().length;
                var masa_kerja = $('#masa_kerja').val().length;

                if (nama == 0 || usia == 0 || pendidikan == 0 || jabatan == 0 || jenis_pekerjaan == 0 || masa_kerja == 0) {
                    alert("Form Harus di isi semua");
                    return false;
                } else {
                    $("#signup_form").submit();
                }
            });

            $('.btn-login').click(function(e) {
                e.preventDefault();

                var email = $('#login_email').val().length;
                var hp = $('#login_hp').val().length;

                if (email == 0 || hp == 0) {
                    alert("Email dan Np Hp harus dilengkapi");
                    return false;
                } else {
                    $("#signin_form").submit();
                }
            });

			@isset($_GET['error'])
				@if($_GET['error'] == 'wrong_email')
					alert('Email belum terdaftar, silahkan melakukan registrasi terlebih dulu.')
				@elseif($_GET['error'] == 'wrong_login')
					alert('Email dan no hp yang dimasukkan belum sesuai. Silahkan ulangi.')
				@endisset
			@endisset
		});
	</script>
@endpush
