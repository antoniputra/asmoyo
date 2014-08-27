@section('title') Daftar Posting @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Daftar Posting
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.post._menu')

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$posts['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$posts['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$posts['status']}}</b></a>
			</li>
		</ul>

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Kategori </th>
					<th> Status </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($posts['total'])
				@foreach($posts['items'] as $post)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$post['title']}} </td>
						<td> {{$post['groupable']['title']}} </td>
						<td> {{$post['status']}} </td>
						<td>
							<a href="{{route('admin.post.edit', $post['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.post.destroy', $post['id']),
								array(
									'icon'	=> 'fa fa-trash-o',
									'class'	=> 'btn btn-danger btn-sm'
								),
								'Apakah anda yakin ?'
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

		{{$posts->appends(array('sortir' => $posts['sortir'], 'status' => $posts['status']))->links()}}

	</div>
</div>