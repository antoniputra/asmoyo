@section('title') Daftar Halaman @stop

@section('before_content')
	@include($theme_path .'content.page._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Daftar Halaman
	</h3>
	<div class="box-content">

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$pages['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$pages['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$pages['status']}}</b></a>
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
				@if($pages['items'])
				@foreach($pages['items'] as $page)
					<tr>
						<td> {{$page['title']}} </td>
						<td> {{$page['status']}} </td>
						<td>
							<a href="{{admin_route('page.show', $page['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{admin_route('page.edit', $page['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus', 'DELETE', admin_route('page.destroy', $page['id']),
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

		{{$pages->appends(array('sortir' => $pages['sortir'], 'status' => $pages['status']))->links()}}

	</div>
</div>