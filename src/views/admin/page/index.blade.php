@section('title') Daftar Halaman @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Daftar Halaman
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.page._menu')

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
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Status </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($pages['total'])
				@foreach($pages['items'] as $page)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$page['title']}} </td>
						<td> {{$page['status']}} </td>
						<td>
							<a href="{{route('admin.page.edit', $page['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							@if( ! $page['is_locked'] )
								{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.page.destroy', $page['id']), array(
										'icon'	=> 'fa fa-trash-o',
										'class'	=> 'btn btn-danger btn-sm'
									),
									'Anda yakin ?'
								)}}
							@endif
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