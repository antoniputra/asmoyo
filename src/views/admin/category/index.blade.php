@section('title') Daftar Kategori @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Daftar Kategori
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.category._menu')

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
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Status </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($categories['total'])
				@foreach($categories['items'] as $category)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$category['title']}} </td>
						<td> {{$category['status']}} </td>
						<td>
							<a href="{{route('admin.category.edit', $category['slug'])}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.category.destroy', $category['id']),
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

		{{$categories->appends(array('sortir' => $categories['sortir'], 'status' => $categories['status']))->links()}}

	</div>
</div>