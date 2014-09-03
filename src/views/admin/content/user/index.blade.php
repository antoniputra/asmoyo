@section('title') Daftar User @stop

@section('before_content')
	@include($theme_path .'content.user._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-users"></i>
		Daftar User
	</h3>
	<div class="box-content">

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
					<th> Title </th>
					<th> Status </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($users['items'])
				@foreach($users['items'] as $u)
					<tr>
						<td> {{$u['fullname']}} (<small>{{$u['username']}}</small>) </td>
						<td> {{ $u['activated'] ? 'aktif' : 'tidak aktif' }} </td>
						<td>
							<a href="{{admin_route('user.show', $u['id'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							{{-- <a href="{{admin_route('user.edit', $u['username'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a> --}}
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('user.forceDestroy', $u['id']),
								array(
									'icon'	=> 'fa fa-trash-o',
									'class'	=> 'btn btn-danger btn-sm'
								),
								'Apakah anda yakin ?'
							) }}
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

		{{$users->appends(array('sortir' => $users['sortir'], 'status' => $users['status']))->links()}}

	</div>
</div>