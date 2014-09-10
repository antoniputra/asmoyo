@section('title') Halaman - {{$page['title']}} @stop

@section('before_content')
	@include($theme_path .'content.page._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Halaman : {{$page['title']}}
		<div>
			<a href="{{ route('page.show', $page['slug']) }}" class="text-link">
				<small>
					<i class="fa fa-link"></i>
					{{ route('page.show', $page['slug']) }}
				</small>
			</a>			
		</div>
	</h3>
	<div class="box-content">
		<ul class="list-inline">
			<li>
				<a href="{{ admin_route('page.edit', $page['slug']) }}" class="btn btn-primary">
					<i class="fa fa-pencil"></i>
					Edit
				</a>
			</li>
			<li>
				<a class="btn btn-default">
					Status : <b>{{$page['status']}}</b>
				</a>
			</li>
		</ul>

		<hr>
		<blockquote>
			<p><b>Description</b></p>
			<p>{{$page['description']}}</p>
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