@section('title') {{$title}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		{{$widget['item']['title']}} (widget: {{$widget['title']}})
		<small>{{$widget['item']['description']}}</small>
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		<div class="list-group">
			@if($content)
			@foreach($content as $c)
				<a @if($c['link']) href="{{$c['link']}}" @endif class="list-group-item">
					<span class="badge">
						<i class="fa fa-arrow-right"></i>
					</span>
					<h4 class="list-group-item-heading">{{$c['title']}}</h4>
					<p class="list-group-item-text">{{$c['description']}}</p>
				</a>
			@endforeach
			@endif
		</div>

	</div>
</div>