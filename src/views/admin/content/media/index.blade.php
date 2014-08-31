@section('title') Daftar Media @stop

@section('before_content')
	@include($theme_path .'content.media._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Daftar Media
	</h3>
	<div class="box-content">

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$medias['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$medias['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$medias['status']}}</b></a>
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
				@if($medias['items'])
				@foreach($medias['items'] as $med)
					<tr>
						<td> {{$med['title']}} </td>
						<td> {{$med['status']}} </td>
						<td>
							<a href="{{admin_route('media.show', $med['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Lihat
							</a>
							<a href="{{admin_route('media.edit', $med['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus', 'DELETE', admin_route('media.destroy', $med['id']),
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

		{{$medias->appends(array('sortir' => $medias['sortir'], 'status' => $medias['status']))->links()}}

	</div>
</div>