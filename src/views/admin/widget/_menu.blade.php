<div style="margin-bottom:10px;">
	<ul class="nav nav-pills asmoyo-nav-pills">
		<li>
			<a href="{{route('admin.widget.index')}}">
				<i class="fa fa-bars"></i>
				Daftar Widget
			</a>
		</li>

		@if( isset($widget) )
			<li>
				<a href="{{route('admin.widget.show', $widget['slug'])}}">
					<i class="fa fa-bars"></i>
					Widget {{$widget['title']}}
				</a>
			</li>
			<li>
				<a href="{{route('admin.widget.item.create', $widget['slug'])}}">
					<i class="fa fa-plus"></i>
					Tambah Baru
				</a>
			</li>
		@endif
		@if( isset($widget['item']) )
			<li>
				<a href="{{ route('admin.widget.item.edit', array($widget['slug'], $widget['item']['id'])) }}">
					<i class="fa fa-pencil"></i>
					Edit
				</a>
			</li>
		@endif
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