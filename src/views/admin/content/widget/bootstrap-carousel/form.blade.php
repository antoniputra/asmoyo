@section('title')
	{{ !isset($cat) ? 'Buat Kategori' : "Edit $cat[title]" }} 
@stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($widget_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		{{ !isset($cat) ? 'Buat Kategori' : "Edit $cat[title]" }}
	</h3>
	<div class="box-content">

		@if( ! isset($cat) )
			{{ Form::open(['url' => admin_route('widget.cat.store', [$widget['name']]), 'class' => 'form-horizontal']) }}
		@else
			{{ Form::model($cat, ['url' => admin_route('widget.cat.update', [$widget['name'], $cat['slug']]), 'method' => 'PUT', 'class' => 'form-horizontal']) }}
		@endif

			<div class="form-group">
				<label class="control-group col-md-2">Title</label>
				<div class="col-md-9">
					{{ Form::text('title', null, ['class' => 'form-control', 'autofocus' => true]) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-group col-md-2">Description</label>
				<div class="col-md-9">
					{{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
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

		{{ Form::close() }}

	</div>
</div>