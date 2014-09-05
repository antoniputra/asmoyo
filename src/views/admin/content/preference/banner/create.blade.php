@section('title') Preference {{$wg['title']}} @stop

@section('before_content')
	@include($theme_path .'content.preference._menu')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-laptop"></i>
		Buat data {{$wg['title']}}
	</h3>
	<div class="box-content">

		{{Form::open(array('url' => admin_route('category.store'), 'class' => 'form-horizontal'))}}
			
			<div class="form-group">
				<label class="control-label col-md-2">Image</label>
				<div class="col-md-10">
					{{ Form::text('title', null, array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2">Description</label>
				<div class="col-md-10">
					{{ Form::textarea('description', null, array('class' => 'form-control', 'rows' => '4')) }}
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