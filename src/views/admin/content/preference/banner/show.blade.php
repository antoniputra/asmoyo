@section('title') Preference {{$wg['title']}} @stop

@section('before_content')
	@include($theme_path .'content.preference._menu')
	@include($wg_path .'_menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-laptop"></i>
		{{$wg['title']}} : {{$pref['title']}}
	</h3>
	<div class="box-content">
		<h4 class="media-heading">{{$pref['title']}}</h4>
		<p>{{$pref['description']}}</p>
		<hr>

		@if( $pref['datas']->count() )
			@foreach($pref['datas'] as $data)

			@endforeach
		@else
			<h4>Tidak ada {{$wg['title']}} data</h4>
		@endif

	</div>
</div>