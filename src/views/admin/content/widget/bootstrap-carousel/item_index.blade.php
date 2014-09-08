@section('title') {{$widget['title']}} @stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar - {{$widget['title']}}
		&nbsp;
		<a href="{{admin_route( 'widget.item.create', [$wg_uri, $widget['slug']] )}}" class="btn btn-primary btn-sm">
			<i class="fa fa-plus"></i>
			Tambah Item
		</a>
	</h3>
	<div class="box-content">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th style="width:70%;">Item</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@if( count($items) )
				@foreach($items as $key => $item)
					<tr>
						<td>
							<div class="thumbnail">
								<img src="{{ $item['image'] }}">
							</div>
							<h4>{{$item['title']}}</h4>
							<p>{{$item['description']}}</p>
						</td>
						<td style="vertical-align:middle;">
							<a href="{{ admin_route('widget.item.edit', [$wg_uri, $widget['slug'], $item['id']]) }}" class="btn btn-default btn-sm">
								<i class="fa fa-pencil"></i> Edit
							</a>
							{{ Form::link('Hapus Permanent', 'DELETE', admin_route('widget.item.forceDestroy', array($wg_uri, $widget['slug'], $item['id'])),
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
					<h4>Tidak ada item</h4>
				@endif
			</tbody>
		</table>
	</div>
</div>