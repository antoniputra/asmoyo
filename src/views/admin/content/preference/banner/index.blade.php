@section('title') Daftar Banner @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-laptop"></i>
		Daftar Banner
	</h3>
	<div class="box-content">

		@if($preferences)
		@foreach($preferences as $p)

			<p>{{$p['title']}}</p>

		@endforeach
		@endif

	</div>
</div>