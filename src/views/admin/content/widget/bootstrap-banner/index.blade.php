@section('title') Daftar Banner @stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar - {{$wg['title']}}
	</h3>
	<div class="box-content">

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if( count($widgets) )
				@foreach($widgets as $widget)
					<tr>
						<td>
							<h4>{{$widget['title']}}</h4>
							<p>{{$widget['description']}}</p>
						</td>
						<td>
							<a href="{{ admin_route('widget.item.show', array($wg_name, $widget['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{ admin_route('widget.item.edit', array($wg_name, $widget['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('widget.item.forceDestroy', array($wg_name, $widget['slug'])),
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
						<td colspan="2">
							<h4>Tidak ada data</h4>
						</td>
					</tr>
				@endif
			</tbody>
		</table>

	</div>
</div>