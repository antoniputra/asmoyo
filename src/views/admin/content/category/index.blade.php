@section('title') Daftar Kategori @stop

@section('before_content')
	@include($theme_path .'content.category._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Daftar Kategori
	</h3>
	<div class="box-content">

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$categories['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$categories['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$categories['status']}}</b></a>
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
				@if($categories['items'])
				@foreach($categories['items'] as $cat)
					<tr>
						<td> {{$cat['title']}} </td>
						<td> {{$cat['status']}} </td>
						<td>
							<a href="{{admin_route('category.show', $cat['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{admin_route('category.edit', $cat['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus', 'DELETE', admin_route('category.destroy', $cat['id']),
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

		{{$categories->appends(array('sortir' => $categories['sortir'], 'status' => $categories['status']))->links()}}

	</div>
</div>