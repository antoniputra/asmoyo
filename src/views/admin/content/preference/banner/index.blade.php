@section('title') Daftar Banner @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Daftar Banner
	</h3>
	<div class="box-content">

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$preferences['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$preferences['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$preferences['status']}}</b></a>
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
				@if($preferences['items'])
				@foreach($preferences['items'] as $p)
					<tr>
						<td> {{$p['title']}} </td>
						<td> {{$p['status']}} </td>
						<td>
							<a href="{{admin_route('category.show', $p['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{admin_route('category.edit', $p['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('category.forceDestroy', $p['id']),
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

		{{$preferences->appends(array('sortir' => $preferences['sortir'], 'status' => $preferences['status']))->links()}}

	</div>
</div>