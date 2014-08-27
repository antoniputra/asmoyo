@section('title') Edit User {{$user['username']}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-users"></i>
		Edit User : {{$user['username']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.user._menu')

		{{Form::model($user, array('route' => array('admin.user.update', $user['username']), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			{{Form::hidden('id', null)}}

			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">
					Username
				</label>
				<div class="col-sm-10">
					{{Form::text('username', null, array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'username'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">
					Email
				</label>
				<div class="col-sm-10">
					{{Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'email'))}}
				</div>
			</div>
			
			<div class="form-group">
				<label for="fullname" class="col-sm-2 control-label">
					Nama Lengkap
				</label>
				<div class="col-sm-10">
					{{Form::text('fullname', null, array('class' => 'form-control', 'id' => 'fullname', 'placeholder' => 'fullname'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="birthday" class="col-sm-2 control-label">
					Birthday
				</label>
				<div class="col-sm-10">
					{{Form::text('birthday', null, array('class' => 'form-control', 'id' => 'birthday', 'placeholder' => 'birthday'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="gender" class="col-sm-2 control-label">
					Gender
				</label>
				<div class="col-sm-10">
					<div class="radio">
						<label>
							{{Form::radio('gender', 'male', null)}} Male
						</label>
					</div>
					<div class="radio">
						<label>
							{{Form::radio('gender', 'female', null)}} Female
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="col-sm-2 control-label">
					Kota
				</label>
				<div class="col-sm-10">
					{{Form::text('city', null, array('class' => 'form-control', 'id' => 'city', 'placeholder' => 'city'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="address" class="col-sm-2 control-label">
					Alamat
				</label>
				<div class="col-sm-10">
					{{Form::textarea('address', null, array('class' => 'form-control', 'id' => 'address', 'rows' => '3', 'placeholder' => 'address'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">
					Deskripsi
				</label>
				<div class="col-sm-10">
					{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'placeholder' => 'description'))}}
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