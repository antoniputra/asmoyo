@extends($layout)

@section('body')
	<div class="row">
		<div class="col-md-1">
			@section('sideLeft')
				@include($theme_path .'partial.side_left')
			@show
		</div>

		<div class="col-md-8">
			<div class="content">
				@yield('before_content')
				
				{{$content}}

				@yield('after_content')
			</div>
		</div>

		<div class="col-md-3">
			@section('sideRight')
				
			@show
		</div>
	</div>
@stop