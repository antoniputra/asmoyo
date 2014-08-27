<div style="margin-bottom:10px;">
	<ul class="nav nav-pills asmoyo-nav-pills">
		<li>
			<a href="{{route('admin.gallery.index')}}">
				<i class="fa fa-bars"></i>
				Daftar Gallery
			</a>
		</li>
		<li>
			<a href="{{route('admin.gallery.create')}}">
				<i class="fa fa-plus"></i>
				Buat Baru
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
		<p>
			@if(is_array($alert['text']))
				@foreach($alert['text'] as $m)
					<li>{{$m}}</li>
				@endforeach
			@else
				{{$alert['text']}}
			@endif
		</p>
	</div>
@endif