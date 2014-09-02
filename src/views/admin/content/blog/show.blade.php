@section('title') Blog - {{$blog['title']}} @stop

@section('before_content')
	@include($theme_path .'content.blog._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Blog : {{$blog['title']}}
	</h3>
	<div class="box-content">
		<blockquote>
			<p><b>Description</b></p>
			{{$blog['description']}}
		</blockquote>
		
		<hr>
		<div>
			{{$blog['content']}}
		</div>
		<hr>

		<div class="well">
			<div>
				<h5><b>Meta Keywords</b></h5>
				<p>{{$blog['meta_keywords']}}</p>
			</div>
			<div>
				<h5><b>Meta Description</b></h5>
				<p>{{$blog['meta_description']}}</p>
			</div>
		</div>
	</div>
</div>