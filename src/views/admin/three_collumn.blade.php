@extends($layout)

<div class="row">
	
	<div class="col-md-1">
		@section('sideLeft')
			Sidebar Kiri
		@show
	</div>

	<div class="col-md-8">
		@section('content')
			&nbsp;
		@show
	</div>

	<div class="col-md-3">
		@section('sideRight')
			Ini adalah sidebar kanan
		@show
	</div>

</div>