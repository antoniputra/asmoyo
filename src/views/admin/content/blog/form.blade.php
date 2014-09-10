@section('title')
	{{ $title }}
@stop

@include($theme_path .'partial._conf_froala')

@section('before_content')
	@include($theme_path .'content.blog._menu')
@stop

@if( ! isset($blog) )
	{{ Form::open(array('url' => admin_route('blog.store'), 'class' => 'form-horizontal row')) }}
@else
	{{ Form::model($blog, array('url' => admin_route('blog.update', $blog['id']), 'method' => 'PUT', 'class' => 'form-horizontal row')) }}
@endif
	<div class="col-md-8">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				{{ $title }}
			</h3>
			<div class="box-content">
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label" for="title">
						Title
					</label>
					<div class="col-sm-10">
						{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'asmoyo-helper' => 'GenerateSlug', 'placeholder' => 'title'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="slug" class="col-sm-2 control-label" for="slug">
						Url
					</label>
					<div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon">
								{{route('blog.show', '')}}
							</div>
							{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="media_id" class="col-sm-2 control-label">
						Gambar
					</label>
					<div class="col-sm-10">
						{{Form::text('image', null, array('id' => 'image', 'class'=>'form-control'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="description" class="col-sm-2 control-label" for="description">
						Description
					</label>
					<div class="col-sm-10">
						{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'rows' => '5', 'placeholder' => 'description'))}}
					</div>
				</div>

				<div class="form-group">
					<div class="form-group">
						<label for="content" class="col-sm-12 text-center">
							Content
						</label>
						<div class="col-sm-12">
							{{Form::textarea('content', null, array('class' => 'form-control froala_editor', 'id' => 'content', 'placeholder' => 'content', 'style' => 'height:600px;'))}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-gear"></i>
				Pengaturan
			</h3>
			<div class="box-content">
				<div class="form-group">
					<label for="category_id" class="">
						Category
					</label>
					<div class="">
						{{Form::select('category_id', $categoryList, null, array('class' => 'form-control', 'category_id'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="status" class="">
						Status
					</label>
					<div class="">
						{{Form::select('status', $statusList, null, array('class' => 'form-control', 'id' => 'status', 'placeholder' => 'status'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="comment_status" class="">
						Comment Status
					</label>
					<div class="">
						{{Form::select('comment_status', array('tidak aktif', 'aktif'), null, array('class' => 'form-control', 'id' => 'comment_status', 'placeholder' => 'Comment Status'))}}
					</div>
				</div>

				<hr>

				<div class="form-group">
					<label class="" for="options.before_content">
						Before Content
					</label>
					<div class="">
						{{Form::select('options[before_content]', $widgets, null, array('class' => 'form-control', 'id' => 'options.before_content'))}}
					</div>
				</div>

				<div class="form-group">
					<label class="" for="options.after_content">
						After Content
					</label>
					<div class="">
						{{Form::select('options[after_content]', $widgets, null, array('class' => 'form-control', 'id' => 'options.after_content'))}}
					</div>
				</div>

				<hr>

				<div class="form-group">
					<label class="" for="meta_keywords">Meta Keyword</label>
					<div class="">
						{{ Form::textarea('meta_keywords', null, array('class' => 'form-control', 'id' => 'meta_keywords', 'rows' => '3')) }}
					</div>
				</div>

				<div class="form-group">
					<label class="" for="meta_description">
						Meta Description
					</label>
					<div class="">
						{{ Form::textarea('meta_description', null, array('class' => 'form-control', 'id' => 'meta_description', 'rows' => '3')) }}
					</div>
				</div>

				<hr>
				<div class="form-group text-center">
					<button type="submit" class="btn btn-primary btn-lg">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div>
		</div>
	</div>
{{ Form::close() }}