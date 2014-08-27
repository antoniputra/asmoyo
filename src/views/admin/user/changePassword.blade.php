@section('title') Ubah Password Admin @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-users"></i>
		Ubah Password Admin
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.user._menu')

		{{Form::model($user, array('route' => array('admin.user.putChangePassword', $user['username']), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			{{Form::hidden('id', null)}}

			<div class="form-group">
				<label for="password" class="col-sm-3 control-label">
					Password
				</label>
				<div class="col-sm-9">
					{{Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'password', 'autofocus' => true))}}
				</div>
			</div>

			<div class="form-group">
				<label for="password_confirmation" class="col-sm-3 control-label">
					Password Confirmation
				</label>
				<div class="col-sm-9">
					{{Form::password('password_confirmation', array('class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => 'password_confirmation'))}}
				</div>
			</div>

			<hr>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan Perubahan
					</button>
				</div>
			</div>
		{{Form::close()}}

	</div>
</div>