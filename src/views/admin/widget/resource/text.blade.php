@section('title') {{$title}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		{{$widget['item']['title']}} (widget: {{$widget['title']}})
		<small>{{$widget['item']['description']}}</small>
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		{{$content['text']}}

	</div>
</div>