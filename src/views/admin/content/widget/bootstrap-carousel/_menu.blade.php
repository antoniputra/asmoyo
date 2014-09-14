<nav class="navbar navbar-default" role="navigation" style="margin:0px;">
  	<div class="container-fluid">
		<a class="navbar-brand">
			{{ $widget['title'] }}
		</a>
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ admin_route('widget.cat.index', array($widget['name'])) }}">
					<i class="fa fa-bars"></i>
					Daftar
				</a>
			</li>
			<li>
				<a href="{{admin_route('widget.cat.create', array($widget['name']))}}">
					<i class="fa fa-plus"></i>
					Buat Kategori
				</a>
			</li>
		</ul>
	</div>
</nav>