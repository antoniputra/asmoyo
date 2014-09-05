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
				@if($preferences)
				@foreach($preferences as $p)
					<tr>
						<td>
							<h4>{{$p['title']}}</h4>
							<p>{{$p['description']}}</p>
						</td>
						<td>
							<a href="{{ admin_route('preference.data.show', array($wg_name, $p['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-search"></i> Lihat
							</a>
							<a href="{{ admin_route('preference.data.edit', array($wg_name, $p['slug'])) }}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('preference.data.forceDestroy', array($wg_name, $p['slug'])),
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