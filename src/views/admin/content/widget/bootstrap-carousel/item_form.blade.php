@section('title')
	{{ !isset($item) ? "Tambah Item : $cat[title]" : "Edit Item $item[title]" }}
@stop

@section('before_content')
	@include($theme_path .'content.widget._menu')
	@include($widget_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		{{ !isset($item) ? "Tambah Item : $cat[title]" : "Edit Item $item[title]" }}
	</h3>
	<div class="box-content">

		@if( ! isset($item) )
			{{ Form::open(['url' => admin_route('widget.item.store', [$widget['name'], $cat['slug']]), 'class' => 'form-horizontal']) }}
		@else
			{{ Form::model($item, ['url' => admin_route('widget.item.update', [$widget['name'], $cat['slug'], $item['id']]), 'method' => 'PUT', 'class' => 'form-horizontal']) }}
		@endif

			{{ Form::hidden('category_id', $cat['id']) }}

			<div class="form-group">
				<label class="control-group col-md-2">Image</label>
				<div class="col-md-9">
					{{ Form::text('image', null, ['class' => 'form-control']) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-group col-md-2">Title</label>
				<div class="col-md-9">
					{{ Form::text('title', null, ['class' => 'form-control', 'autofocus' => true]) }}
				</div>
			</div>

			<div class="form-group">
				<label for="order" class="control-group col-md-2">Urutan</label>
				<div class="col-md-9">
					{{ Form::input('number', 'order', null, ['class' => 'form-control', 'min' => 0, 'max' => 10]) }}
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