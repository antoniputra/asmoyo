@extends($layout)

@section('body')
	<div class="container-fluid asmoyo-container">
		<div class="row">
			
			<div class="col-md-1">
				@section('sideLeft')
					@include($theme_path .'partial.side_left')
				@show
			</div>

			<div class="col-md-11">
				<div class="content">
					{{$content}}
				</div>
			</div>

		</div>
	</div>
@stop