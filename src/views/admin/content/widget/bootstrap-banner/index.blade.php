@section('title') Daftar Banner @stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-laptop"></i>
		Daftar Banner
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
				@if($widgets)
				@foreach($widgets as $w)
					<tr>
						<td>
							<h4>{{$w['title']}}</h4>
							<p>{{$w['description']}}</p>
						</td>
						<td>
							<a href="{{ admin_route('widget.item.show', array($wg_name, $w['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{ admin_route('widget.item.edit', array($wg_name, $w['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('widget.item.forceDestroy', array($wg_name, $w['slug'])),
								array(
									'icon'	=> 'fa fa-trash-o',
									'class'	=> 'btn btn-danger btn-sm'
								),
								'Apakah anda yakin ?'
							) }}
						</td>
					</tr>
				@endforeach
				@endif
			</tbody>
		</table>

	</div>
</div>