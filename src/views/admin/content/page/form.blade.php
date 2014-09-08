@section('title')
	{{ $title }}
@stop

@include($theme_path .'partial._conf_froala')

@section('before_content')
	@include($theme_path .'content.page._menu')
@stop

@if( ! isset($page) )
	{{ Form::open(array('url' => admin_route('page.store'), 'class' => 'form-horizontal row')) }}
@else
	{{Form::model($page, array('url' => admin_route('page.update', $page['id']), 'method' => 'PUT', 'class' => 'form-horizontal row'))}}
@endif

	<div class="col-md-8">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-files-o"></i>
				{{ $title }}
			</h3>
			<div class="box-content">
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label" for="title">
						Title
					</label>
					<div class="col-sm-10">
						{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'asmoyo-helper' => 'GenerateSlug', 'placeholder' => 'title', 'autofocus' => true))}}
					</div>
				</div>

				<div class="form-group">
					<label for="slug" class="col-sm-2 control-label" for="slug">
						Url
					</label>
					<div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon">
								{{route('page.show', '')}}
							</div>
							{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="description" class="col-sm-2 control-label" for="description">
						Description
					</label>
					<div class="col-sm-10">
						{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'rows' => '4', 'placeholder' => 'description'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="content" class="col-sm-12" for="content">
						Content
					</label>
					<div class="col-sm-12">
						{{Form::textarea('content', null, array('class' => 'form-control froala_editor', 'id' => 'content', 'placeholder' => 'content', 'style' => 'height:600px;'))}}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-files-o"></i>
				Pengaturan
			</h3>
			<div class="box-content">
				<div class="form-group">
					<label for="parent_id" class="" for="parent_id">
						Induk Halaman
					</label>
					<div class="">
						{{Form::select('parent_id', $parentList, null, array('class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Induk Halaman ?'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="status" class="" for="status">
						Status
					</label>
					<div class="">
						{{Form::select('status', $statusList, null, array('class' => 'form-control', 'id' => 'status'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="status" class="" for="options.before_content">
						Before Content
					</label>
					<div class="">
						{{Form::select('options[before_content]', $widgets, null, array('class' => 'form-control', 'id' => 'options.before_content'))}}
					</div>
				</div>

				<div class="form-group">
					<label class="" for="meta_keywords">
						Meta Keyword
					</label>
					<div class="">
						{{ Form::textarea('meta_keywords', null, array('class' => 'form-control', 'rows' => '3', 'id' => 'meta_keywords')) }}
					</div>
				</div>

				<div class="form-group">
					<label class="" for="meta_description">
						Meta Description
					</label>
					<div class="">
						{{ Form::textarea('meta_description', null, array('class' => 'form-control', 'rows' => '3', 'id' => 'meta_description')) }}
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