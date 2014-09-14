@section('title') {{$cat['title']}} @stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($widget_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar - {{$cat['title']}}
		&nbsp;
		<a href="{{admin_route( 'widget.item.create', [$widget['name'], $cat['slug']] )}}" class="btn btn-primary btn-sm">
			<i class="fa fa-plus"></i>
			Tambah Item
		</a>
	</h3>
	<div class="box-content">
		@if( count($items) )
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th style="width:30%;">Image</th>
						<th style="width:40%;">Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $key => $item)
						<tr>
							<td>
								<div class="thumbnail">
									<img src="{{ $item['image'] }}">
								</div>
							</td>
							<td>
								<h4>{{$item['title']}}</h4>
								<p>{{$item['description']}}</p>
							</td>
							<td style="vertical-align:middle;">
								<a href="{{ admin_route('widget.item.edit', [$widget['name'], $cat['slug'], $item['id']]) }}" class="btn btn-default btn-sm">
									<i class="fa fa-pencil"></i> Edit
								</a>
								{{ Form::link('Hapus Permanent', 'DELETE', admin_route('widget.item.forceDestroy', array($widget['name'], $cat['slug'], $item['id'])),
									array(
										'icon'	=> 'fa fa-trash-o',
										'class'	=> 'btn btn-danger btn-sm'
									),
									'Apakah anda yakin ?'
								) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<h4>Tidak ada item</h4>
		@endif
	</div>
</div>