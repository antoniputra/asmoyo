<div style="margin-bottom:10px;">
	<ul class="nav nav-pills asmoyo-nav-pills">
		<li>
			<a href="{{route('admin.option.web')}}">
				<i class="fa fa-globe"></i>
				Web
			</a>
		</li>
		<li>
			<a href="{{route('admin.option.media')}}">
				<i class="fa fa-picture-o"></i>
				Media
			</a>
		</li>
		<li>
			<a href="{{route('admin.option.media')}}">
				<i class="fa fa-laptop"></i>
				Template
			</a>
		</li>
	</ul>
</div>
<hr>

@if($alert = Session::get('alert'))
	<div class="alert alert-{{$alert['type']}}">
		<a class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</a>

		<h4>{{$alert['title']}}</h4>
		<p>{{$alert['text']}}</p>
	</div>
@endif