@section('title') Buat Blog @stop

@include($theme_path .'partial._conf_froala')

@section('before_content')
	@include($theme_path .'content.blog._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-file-text-o"></i>
		Buat Blog
	</h3>
	<div class="box-content">

		{{Form::open(array('url' => admin_route('blog.store'), 'class' => 'form-horizontal'))}}

			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">
					Title
				</label>
				<div class="col-sm-10">
					{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'asmoyo-helper' => 'GenerateSlug', 'placeholder' => 'title'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">
					Slug
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
				<label for="category_id" class="col-sm-2 control-label">
					Category
				</label>
				<div class="col-sm-10">
					{{Form::select('category_id', $categoryList, null, array('class' => 'form-control', 'category_id'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="status" class="col-sm-2 control-label">
					Status
				</label>
				<div class="col-sm-10">
					{{Form::select('status', $statusList, null, array('class' => 'form-control', 'id' => 'status', 'placeholder' => 'status'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="status" class="col-sm-2 control-label">
					Comment Status
				</label>
				<div class="col-sm-10">
					{{Form::select('comment_status', array('tidak aktif', 'aktif'), null, array('class' => 'form-control', 'id' => 'comment_status', 'placeholder' => 'Comment Status'))}}
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Meta Keyword</label>
				<div class="col-md-9">
					{{ Form::textarea('meta_keywords', null, array('class' => 'form-control', 'rows' => '3')) }}
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-3 control-label">Meta Description</label>
				<div class="col-md-9">
					{{ Form::textarea('meta_description', null, array('class' => 'form-control', 'rows' => '3')) }}
				</div>
			</div>

			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">
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
			
			<hr>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>