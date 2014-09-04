@section('title') Preference {{$pref_type}} @stop

@section('before_content')
	@include($theme_path .'content.preference._menu')
	@include($pref_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-laptop"></i>
		Buat data {{$pref_type}}
	</h3>
	<div class="box-content">

		{{Form::open(array('url' => admin_route('category.store'), 'class' => 'form-horizontal'))}}
			
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