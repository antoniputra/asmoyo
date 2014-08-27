@section('title') Daftar Gallery @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-folder"></i>
		Daftar Gallery
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.gallery._menu')

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$galleries['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$galleries['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$galleries['status']}}</b></a>
			</li>
		</ul>

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Status </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($galleries['total'])
				@foreach($galleries['items'] as $gallery)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$gallery['title']}} </td>
						<td> {{$gallery['status']}} </td>
						<td>
							<a href="{{route('admin.gallery.edit', $gallery['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.gallery.destroy', $gallery['id']),
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

		{{$galleries->appends(array('sortir' => $galleries['sortir'], 'status' => $galleries['status']))->links()}}

	</div>
</div>