<nav class="navbar navbar-default" role="navigation" style="margin:0px;">
  	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ admin_route('preference.data.index', array($pref_type)) }}">
					<i class="fa fa-bars"></i>
					{{$pref_type}}
				</a>
			</li>
			<li>
				<a href="{{admin_route('preference.data.create', array($pref_type))}}">
					<i class="fa fa-plus"></i>
					Buat {{$pref_type}}
				</a>
			</li>
		</ul>
	</div>
</nav>