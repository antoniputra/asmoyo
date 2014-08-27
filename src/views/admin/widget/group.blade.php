@section('title') Grup Widget : {{$widget['title']}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Grup Widget : {{$widget['title']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$groups->getTotal()}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$groups['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$groups['status']}}</b></a>
			</li>
		</ul>

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Description </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($groups['items'])
				@foreach($groups['items'] as $group)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td> {{$group['title']}} </td>
						<td> {{$group['description']}} </td>
						<td>
							<a href="{{route('admin.widget.group.edit', array($widget['slug'], $group['slug']) )}}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.widget.group.destroy', array($widget['slug'], $group['id']) ),
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

		{{$groups->appends(array('sortir' => $groups['sortir'], 'status' => $groups['status']))->links()}}

	</div>
</div>