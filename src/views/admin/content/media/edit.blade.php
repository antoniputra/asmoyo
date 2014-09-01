@section('title') Edit Media - {{$media['title']}} @stop

@section('stylesheets')
	@parent
	{{ HTML::style('packages/antoniputra/asmoyo/admin/plugin/bs3-file-input/fileinput.min.css') }}
@stop

@section('javascripts')
	@parent
	{{ HTML::script('packages/antoniputra/asmoyo/admin/plugin/bs3-file-input/fileinput.min.js') }}

	<script type="text/javascript">
		$("#content").fileinput({
			initialPreview: [
				"<img src='{{getThumb($media['content'])}}' class='file-preview-image'>",
			],
			overwriteInitial: true,
			maxFileSize: 100,

			browseClass: "btn btn-success btn-block",
			removeClass: "btn btn-danger btn-block",
			showCaption: false,
			showRemove: false,
			showUpload: false,
			maxFileSize: 2000
		});
	</script>
@stop

@section('before_content')
	@include($theme_path .'content.media._menu')
@stop

{{ Form::model($media, array('url' => admin_route('media.update', $media['id']), 'method' => 'PUT', 'files' => true, 'class' => 'form row')) }}
	<div class="col-md-5">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-image"></i>
				Image
			</h3>
			<div class="box-content">
				<div class="form-group">
					<label for="content">Image</label>
					{{ Form::file('content', array('class' => 'form-control file', 'id' => 'content')) }}
					
					{{ Form::hidden('content', null, array('class' => 'form-control')) }}
					{{ Form::hidden('mime_type', null, array('class' => 'form-control')) }}
					{{ Form::hidden('size', null, array('class' => 'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-7">
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-info-circle"></i>
				Informasi
			</h3>
			<div class="box-content">
				<div class="form-group row">
					<div class="col-md-6">
						<label for="title">Title</label>
						{{Form::text('title', null, array('class' => 'form-control', 'title'))}}
					</div>
					<div class="col-md-6">
						<label for="title">Description</label>
						{{Form::textarea('description', null, array('class' => 'form-control', 'description', 'rows' => '3'))}}
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="status">Status</label>
						{{Form::select('status', $statusList, null, array('class' => 'form-control', 'status'))}}
					</div>
					<div class="col-md-6">
						<label for="category_id">Category</label>
						{{Form::select('category_id', $categoryList, null, array('class' => 'form-control', 'category_id'))}}
					</div>
				</div>

				<hr>
				<button type="submit" class="btn btn-primary btn-block btn-lg">
					Simpan
				</button>
			</div>
		</div>
	</div>
{{ Form::close() }}