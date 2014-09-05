<nav class="navbar navbar-default" role="navigation" style="margin:0px;">
  	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ admin_route('widget.item.index', array($wg_name)) }}">
					<i class="fa fa-bars"></i>
					{{$wg['title']}}
				</a>
			</li>
			<li>
				<a href="{{admin_route('widget.item.create', array($wg_name))}}">
					<i class="fa fa-plus"></i>
					Buat {{$wg['title']}}
				</a>
			</li>
		</ul>
	</div>
</nav>