@section('title') Kategori {{$cat['title']}} @stop

@section('before_content')
	@include($theme_path .'content.category._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Kategori : {{$cat['title']}}
	</h3>
	<div class="box-content">
		<div class="media">
			<a class="pull-left thumbnail" href="#">
				<img class="media-object" src="/holder.js/150x150">
			</a>
			<div class="media-body">
				<h4 class="media-heading">{{$cat['title']}}</h4>
				<p>{{$cat['description']}}</p>
			</div>
		</div>
	</div>
</div>