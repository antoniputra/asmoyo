@section('title') Halaman - {{$page['title']}} @stop

@section('before_content')
	@include($theme_path .'content.page._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Halaman : {{$page['title']}}
	</h3>
	<div class="box-content">
		<blockquote>
			<p><b>Description</b></p>
			{{$page['description']}}
		</blockquote>
		
		<hr>
		<div>
			{{$page['content']}}
		</div>
		<hr>

		<div class="well">
			<div>
				<h5><b>Meta Keywords</b></h5>
				<p>{{$page['meta_keywords']}}</p>
			</div>
			<div>
				<h5><b>Meta Description</b></h5>
				<p>{{$page['meta_description']}}</p>
			</div>
		</div>
	</div>
</div>