@section('title') Daftar Blog @stop

@section('before_content')
	@include($theme_path .'content.blog._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Daftar Blog
	</h3>
	<div class="box-content">

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$blogs['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$blogs['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$blogs['status']}}</b></a>
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
				@if($blogs['items'])
				@foreach($blogs['items'] as $blog)
					<tr>
						<td> {{$blog['title']}} </td>
						<td> {{$blog['status']}} </td>
						<td>
							<a href="{{admin_route('blog.show', $blog['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{admin_route('blog.edit', $blog['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus', 'DELETE', admin_route('blog.destroy', $blog['id']),
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

		{{$blogs->appends(array('sortir' => $blogs['sortir'], 'status' => $blogs['status']))->links()}}

	</div>
</div>