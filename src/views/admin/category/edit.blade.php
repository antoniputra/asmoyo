@section('title') Edit Kategori {{$category['title']}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Edit Kategori
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.category._menu')

		{{Form::model($category, array('route' => array('admin.category.update', $category['slug']), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			{{Form::hidden('id', null, array('id' => 'id', 'class'=>'form-control'))}}

			<div class="form-group">
				<label for="media_id" class="col-sm-2 control-label">
					Gambar
				</label>
				<div class="col-sm-10">
					{{Form::hidden('media_id', null, array('id' => 'media_id', 'class'=>'form-control'))}}
					
					<a id="media_id_preview" class="thumbnail" style="margin:0px; height:300px; background:url('{{getMedia($category['cover']['file'])}}') center no-repeat; "> </a>

					<a href="{{route('admin.media.ajaxIndex')}}" id="forMediaId" class="btn btn-default" data-toggle="modal" data-target="#modalAjax">
						<i class="fa fa-picture-o"></i>
						Select Media
					</a>
				</div>
			</div>

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
							{{route('category.show', '')}}
						</div>
						{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="parent_id" class="col-sm-2 control-label">
					Induk Kategori
				</label>
				<div class="col-sm-10">
					{{Form::select('parent_id', $parentList, null, array('class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Induk Kategori ?'))}}
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
				<label for="description" class="col-sm-2 control-label">
					Description
				</label>
				<div class="col-sm-10">
					{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'rows' => '4', 'placeholder' => 'description'))}}
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

@include('asmoyo::admin.partials.modalAjax')
@section('javascripts')
	@parent
	{{asmoyoAsset( 'js/asmoyo.js', 'admin')}}
	<script type="text/javascript">

		// generate slug
		$('#title').asmoyoHelper();

		// media modal
		$( "#forMediaId" ).asmoyoMediaModal({
			field_id: '#media_id',
			preview: '#media_id_preview'
		}, true);

	</script>
@stop