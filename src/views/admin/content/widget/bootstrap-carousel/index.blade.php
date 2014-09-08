@section('title') Daftar Banner @stop

@section('before_content')
	@parent
	@include($theme_path .'content.widget._menu')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar - {{$wg['title']}}
	</h3>
	<div class="box-content">

		<table class="table table-bordered table-hover">
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
						<td style="vertical-align:middle;">
							<a href="{{ admin_route('widget.cat.show', array($wg_uri, $widget['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{ admin_route('widget.item.index', array($wg_uri, $widget['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-gear"></i> Manage
							</a>
							<a href="{{ admin_route('widget.cat.edit', array($wg_uri, $widget['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('widget.cat.forceDestroy', array($wg_uri, $widget['slug'])),
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