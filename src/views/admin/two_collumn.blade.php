@extends($layout)

@section('body')
	<div class="row">
		<div class="col-md-1">
			@section('sideLeft')
				@include($theme_path .'partial.side_left')
			@show
		</div>

		<div class="col-md-11">
			<div class="content">
				@if( ! isset($login) )
					@include($theme_path .'partial.alert')
				@endif

				@yield('before_content')
				
				{{$content}}

				@yield('after_content')
			</div>
		</div>
	</div>
@stop