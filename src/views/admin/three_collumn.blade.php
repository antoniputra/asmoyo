@extends($layout)

@section('body')
	<div class="container-fluid asmoyo-container">
		<div class="row">
			
			<div class="col-md-1">
				@section('sideLeft')
					@include($theme_path .'partial.side_left')
				@show
			</div>

			<div class="col-md-8">
				<div class="content">
					{{$content}}
				</div>
			</div>

			<div class="col-md-3">
				@section('sideRight')
					jiffie
				@show
			</div>

		</div>
	</div>
@stop