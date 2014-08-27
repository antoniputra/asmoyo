@section('title') Edit Halaman {{$page['title']}} @stop

@include('asmoyo::admin.partials.confFroala')

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-files-o"></i>
		Edit Halaman : {{$page['title']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.page._menu')

		{{Form::model($page, array('route' => array('admin.page.update', $page['slug']), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			{{Form::hidden('id', null)}}

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
							{{url()}}
						</div>
						{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="parent_id" class="col-sm-2 control-label">
					Induk Halaman
				</label>
				<div class="col-sm-10">
					{{Form::select('parent_id', $parentList, null, array('class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Induk Halaman'))}}
				</div>
			</div>
			
			<div class="form-group">
				<label for="structure" class="col-sm-2 control-label">
					Structure
				</label>
				<div class="col-sm-10">
					{{Form::select('structure', $structureList, null, array('class' => 'form-control', 'id' => 'structure', 'placeholder' => 'structure'))}}
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
				<label for="type" class="col-sm-2 control-label">
					Type
				</label>
				<div class="col-sm-10">
					{{Form::select('type', $typeList, null, array('class' => 'form-control', 'id' => 'type', 'placeholder' => 'type'))}}
				</div>
			</div>

			<div id="typeStandard">
				<div class="form-group">
					<label for="content" class="col-sm-12 text-center">
						Content
					</label>
					<div class="col-sm-12">
						{{Form::textarea('content', null, array('class' => 'form-control froala_editor', 'id' => 'content', 'placeholder' => 'content', 'style' => 'height:500px;'))}}
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="meta_title" class="col-sm-2 control-label">
					Meta Title
				</label>
				<div class="col-sm-10">
					{{Form::text('meta_title', null, array('class' => 'form-control', 'id' => 'meta_title', 'placeholder' => 'Meta title'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="meta_keyword" class="col-sm-2 control-label">
					Meta Keyword
				</label>
				<div class="col-sm-10">
					{{Form::textarea('meta_keyword', null, array('class' => 'form-control', 'id' => 'meta_keyword', 'rows' => 3, 'placeholder' => 'Meta keyword'))}}
				</div>
			</div>
			
			<div class="form-group">
				<label for="meta_description" class="col-sm-2 control-label">
					Meta Description
				</label>
				<div class="col-sm-10">
					{{Form::textarea('meta_description', null, array('class' => 'form-control', 'id' => 'meta_description', 'rows' => 3, 'placeholder' => 'Meta description'))}}
				</div>
			</div>

			<hr>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan Perubahan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>

@section('javascripts')
	@parent
	<script type="text/javascript">

		// generate slug
		$('#title').asmoyoHelper();

		var inputType = $('#type'),
			containerType = $('#typeStandard');
		if( inputType.val() != 'standard' )
		{
			containerType.css('display', 'none');
		}

		// event
		inputType.change(function() {
			if( inputType.val() != 'standard' )
			{
				// containerType.css('display', 'none');
				containerType.slideUp('slow', function(){

				});
			} else {
				// containerType.css('display', 'block');
				containerType.slideDown('slow', function(){

				});
			}
		});
	</script>
@stop