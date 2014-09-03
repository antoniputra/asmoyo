@section('title') User {{$user['username']}} @stop

@section('before_content')
	@include($theme_path .'content.user._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-user"></i>
		User : {{$user['fullname']}} <small>( {{$user['username']}} )</small>
	</h3>
	<div class="box-content">
		<div class="media">
			<a class="pull-left thumbnail" href="#">
				<img class="media-object" src="/holder.js/150x150">
			</a>
			<div class="media-body">
				<table class="table table-bordered">
					<tr>
						<th>Fullname</th>
						<td>{{$user['fullname']}}</td>
					</tr>
					<tr>
						<th>Username</th>
						<td>{{$user['username']}}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{$user['email']}}</td>
					</tr>
					<tr>
						<th>Gender</th>
						<td>{{$user['gender']}}</td>
					</tr>
					<tr>
						<th>Address</th>
						<td>{{$user['city']}}, {{$user['address']}}</td>
					</tr>
					<tr>
						<th>Location</th>
						<td>{{$user['location']}}</td>
					</tr>
					<tr>
						<th>description</th>
						<td>{{$user['description']}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>