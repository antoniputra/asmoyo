@section('title') Daftar User @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-users"></i>
		Daftar User
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.user._menu')

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$users['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$users['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$users['status']}}</b></a>
			</li>
		</ul>

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Nama Lengkap </th>
					<th> Email </th>
					<th> Jenis Kelamin </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($users['total'])
				@foreach($users['items'] as $user)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td>
							<div>{{$user['fullname']}}</div>
							<label>{{$user['username']}}</label>
						</td>
						<td> {{$user['email']}} </td>
						<td> {{$user['gender']}} </td>
						<td>
							<a href="{{route('admin.user.edit', $user['username'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.user.destroy', $user['id']), 
								array(
									'icon'	=> 'fa fa-trash-o',
									'class'	=> 'btn btn-danger btn-sm'
								),
								'apakah anda yakin ?'
							)}}
						</td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="3">
							<h4>Tidak ada data</h4>
						</td>
					</tr>
				@endif
			</tbody>
		</table>

		{{$users->links()}}

	</div>
</div>