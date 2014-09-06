@section('title') Daftar Widget @stop

@section('before_content')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		Daftar Widget
	</h3>
	<div class="box-content">
		<div class="row">
			@if($widgets)
			@foreach($widgets as $name => $widget)
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<div class="caption">
							<h3>{{$widget['title']}}</h3>
							<p>
								{{$widget['description']}}
							</p>
							<p>
								<a href="{{admin_route('widget.item.index', array($name))}}" class="btn btn-primary">
									Manage
								</a>
							</p>
						</div>
					</div>
				</div>
			@endforeach
			@endif
		</div>
	</div>
</div>