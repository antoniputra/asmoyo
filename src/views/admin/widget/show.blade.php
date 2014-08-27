@section('title') Daftar Widget @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar Widget : {{$widget['title']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($widget['items'])
				@foreach($widget['items'] as $item)
					<tr>
						<td>{{$itemNumber++}}</td>
						<td>
							{{$item['title']}}
							<p><small>{{$item['description']}}</small></p>
						</td>
						<td>
							<a href="{{route('admin.widget.item.show', array($widget['slug'], $item['id']))}}" class="btn btn-default btn-sm">
								Lihat
							</a>
							<a href="{{route('admin.widget.item.edit', array($widget['slug'], $item['id']))}}" class="btn btn-default btn-sm">
								Edit
							</a>
							{{Form::asmoyoLink('Hapus', 'DELETE', route('admin.widget.item.forceDelete', array($widget['slug'], $item['id'])),
								array(
									'icon'	=> 'fa fa-trash-o',
									'class'	=> 'btn btn-danger btn-sm'
								),
								'Apakah anda yakin ?'
							)}}
						</td>
					</tr>
				@endforeach
				@endif
			</tbody>
		</table>

	</div>
</div>