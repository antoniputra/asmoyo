@section('title') Daftar Banner @stop

@section('before_content')
	@parent
	@include($theme_path .'content.widget._menu')
	@include($widget_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar - {{$widget['title']}}
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
				@if( count($cats) )
				@foreach($cats as $cat)
					<tr>
						<td>
							<h4>{{$cat['title']}}</h4>
							<p>{{$cat['description']}}</p>
						</td>
						<td style="vertical-align:middle;">
							<a href="{{ admin_route('widget.item.index', array($widget['name'], $cat['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-gear"></i> Manage
							</a>
							<a href="{{ admin_route('widget.cat.edit', array($widget['name'], $cat['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('widget.cat.forceDestroy', array($widget['name'], $cat['slug'])),
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