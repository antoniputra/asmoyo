@section('title') Halaman {{$page['title']}} @stop

@section('before_content')
	@include($theme_path .'content.category._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Halaman : {{$page['title']}}
	</h3>
	<div class="box-content">
		@if($page['description'])
			<blockquote>{{$page['description']}}</blockquote>
		@endif

		<div>
			{{$page['content']}}
		</div>

		<div class="well">
			@if($page['meta_keywords'])
				<h5><b>Meta Keywords</b></h5>
				<p>{{$page['meta_keywords']}}</p>
			@endif
			@if($page['meta_description'])
				<h5><b>Meta Description</b></h5>
				<p>{{$page['meta_description']}}</p>
			@endif
		</div>
	</div>
</div>