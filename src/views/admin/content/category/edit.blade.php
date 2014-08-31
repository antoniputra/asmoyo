@section('title') Edit Kategori {{ $category['title'] }} @stop

@section('before_content')
	@include($theme_path .'content.category._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Edit Kategori {{ $category['title'] }}
	</h3>
	<div class="box-content">

		{{Form::model($category, array('method' => 'PUT', 'url' => admin_route('category.update', $category['id']), 'class' => 'form-horizontal'))}}

			<div class="form-group">
				<label for="media_id" class="col-sm-2 control-label">
					Gambar
				</label>
				<div class="col-sm-10">
					{{Form::text('photo', null, array('id' => 'photo', 'class'=>'form-control'))}}
					
					<!-- here is for image -->
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
					{{Form::select('parent_id', asDropdown($parentList), null, array('class' => 'form-control', 'id' => 'parent_id', 'placeholder' => 'Induk Kategori ?'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="status" class="col-sm-2 control-label">
					Status
				</label>
				<div class="col-sm-10">
					{{Form::select('status', asDropdown($statusList), null, array('class' => 'form-control', 'id' => 'status', 'placeholder' => 'status'))}}
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
						Simpan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>