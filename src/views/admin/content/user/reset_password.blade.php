@section('title') Reset Password @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-user"></i>
		Reset Password
	</h3>
	<div class="box-content">

		<div class="alert alert-info">
			Password ini digunakan untuk login ke halaman admin
		</div>

		{{Form::open(array('url' => admin_route('user.putChangePassword'), 'method' => 'PUT', 'class' => 'form-horizontal'))}}
			<div class="form-group">
				<label class="control-label col-md-3">Password Sekarang</label>
				<div class="col-md-8">
					{{ Form::password('password', array('class' => 'form-control', 'autofocus' => true)) }}
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-md-3">Password Baru</label>
				<div class="col-md-8">
					{{ Form::password('new_password', array('class' => 'form-control')) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Konfirmasi Password Baru</label>
				<div class="col-md-8">
					{{ Form::password('new_password_confirmation', array('class' => 'form-control')) }}
				</div>
			</div>

			<hr>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div>
		{{Form::close()}}
	</div>
</div>