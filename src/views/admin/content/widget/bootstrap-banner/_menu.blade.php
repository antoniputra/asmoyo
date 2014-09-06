<nav class="navbar navbar-default" role="navigation" style="margin:0px;">
  	<div class="container-fluid">
		<a class="navbar-brand">
			{{$wg['title']}}
		</a>
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ admin_route('widget.show', array($wg_name)) }}">
					<i class="fa fa-bars"></i>
					Daftar
				</a>
			</li>
			<li>
				<a href="{{admin_route('widget.category.create', array($wg_name))}}">
					<i class="fa fa-plus"></i>
					Buat
				</a>
			</li>
		</ul>
	</div>
</nav>