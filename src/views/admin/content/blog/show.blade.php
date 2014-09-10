@section('title') Blog - {{$blog['title']}} @stop

@section('before_content')
	@include($theme_path .'content.blog._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Blog : {{$blog['title']}}
		<div>
			<a href="{{ route('blog.show', $blog['slug']) }}" class="text-link">
				<small>
					<i class="fa fa-link"></i>
					{{ route('blog.show', $blog['slug']) }}
				</small>
			</a>
		</div>
	</h3>
	<div class="box-content">

		<ul class="list-inline">
			<li>
				<a href="{{ admin_route('blog.edit', $blog['slug']) }}" class="btn btn-primary">
					<i class="fa fa-pencil"></i>
					Edit
				</a>
			</li>
			<li>
				<a class="btn btn-default">
					Status : <b>{{$blog['status']}}</b>
				</a>
			</li>
			<li>
				<a href="{{ admin_route('category.show', $blog['category']['slug']) }}" class="btn btn-default">
					Kategori : <b>{{$blog['category']['title']}}</b>
				</a>
			</li>
			<li>
				<a class="btn btn-default">
					Komentar Status : <b>{{$blog['comment_status'] ? 'Aktif' : 'Tidak Aktif'}}</b>
				</a>
			</li>
		</ul>

		<hr>
		<blockquote>
			<p><b>Description</b></p>
			<p>{{$blog['description']}}</p>
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