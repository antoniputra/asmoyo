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
		<div id="bootstrap-banner" class="carousel slide" data-ride="carousel">
			
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				@if( count($items) )
				@foreach($items as $key => $item)
					<div class="item @if($key == 0) active @endif ">
						<img src="{{$item['image']}}" >
						<div class="carousel-caption">
							<h3>{{$item['title']}}</h3>
							<p>{{$item['description']}}</p>
						</div>
					</div>
				@endforeach
				@endif
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#bootstrap-banner" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#bootstrap-banner" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
</div>