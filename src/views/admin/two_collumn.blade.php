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
				@yield('before_content')

				@if( ! isset($login) )
					@include($theme_path .'partial.alert')
				@endif
				
				{{$content}}

				@yield('after_content')
			</div>
		</div>
	</div>
@stop