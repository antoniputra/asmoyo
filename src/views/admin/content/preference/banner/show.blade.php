@section('title') Preference {{$pref['type']}} @stop

@section('before_content')
	@include($theme_path .'content.preference._menu')
	@include($pref_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Preference {{$pref['type']}} : {{$pref['title']}}
	</h3>
	<div class="box-content">
		<h4 class="media-heading">{{$pref['title']}}</h4>
		<p>{{$pref['description']}}</p>
		<hr>

		@if( $pref['datas']->count() )
			@foreach($pref['datas'] as $data)

			@endforeach
		@else
			<h4>Tidak ada {{$pref['type']}} data</h4>
		@endif

	</div>
</div>