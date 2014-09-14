@section('title') {{$cat['title']}} @stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($widget_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Preview - {{$cat['title']}}
		&nbsp;
		<a href="{{admin_route( 'widget.item.index', [$widget['name'], $cat['slug']] )}}" class="btn btn-primary btn-sm">
			<i class="fa fa-gear"></i>
			Manage Item
		</a>
	</h3>
	<div class="box-content">
		
	</div>
</div>