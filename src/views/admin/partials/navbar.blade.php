<!-- Navbar Menu -->
<div class="navbar navbar-blue navbar-fixed-top asmoyo-navbar">
	<div class="container-fluid asmoyo-navbar-in">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#asmoyo-navbar" style="color:white;">
				<span class="sr-only">Toggle navigation</span>
				<span class="fa fa-bars"></span>
			</button>
			<a class="navbar-brand" href="http://plensip.com" style="color:white;">
				Plensip &nbsp;
			</a>
		</div>

		<!-- Collapse Container -->
		<div class="collapse navbar-collapse" id="asmoyo-navbar">
			<ul class="nav navbar-nav navbar-left">
				<li>
					<a href="{{url()}}" class="show-tooltip" target="_blank">
						Kunjungi Website
					</a>
				</li>
			</ul>

			<!-- <form class="navbar-form navbar-left asmoyo-navbar-form" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Cari...">
				</div>
			</form> -->

			<ul class="nav navbar-nav navbar-right">
				<!-- <li>
					<a href="#" class="show-tooltip" data-placement="bottom" title="Kotak Masuk">
						<span class="fa fa-envelope"></span>
					</a>
				</li> -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{{$auth['username']}} <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{route('admin.user.changePassword')}}">
								Edit Password
							</a>
						</li>
						<li class="divider"> </li>
						<li>
							<a href="{{route('admin.logout')}}">
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>  <!-- End Collapse -->
	</div>
</div>

<!-- Sidebar Menu -->
<div class="asmoyo-side-menu" id="mainSide">
	<ul class="nav">
		<li @if($activePage == 'dashboard') class="active" @endif>
			<a href="{{route('admin.home.dashboard')}}" class="show-tooltip" data-placement="right" title="Dashboard">
				<i class="fa fa-home"></i> Dashboard
			</a>
		</li>
		<li @if($activePage == 'page') class="active" @endif>
			<a href="{{route('admin.page.index')}}" class="show-tooltip" data-placement="right" title="Halaman">
				<i class="fa fa-files-o"></i> Halaman
			</a>
		</li>
		<li @if($activePage == 'category') class="active" @endif>
			<a href="{{route('admin.category.index')}}" class="show-tooltip" data-placement="right" title="Kategori">
				<i class="fa fa-tag"></i> Kategori
			</a>
		</li>
		<li @if($activePage == 'media') class="active" @endif>
			<a href="{{route('admin.media.index')}}" class="show-tooltip" data-placement="right" title="Media">
				<i class="fa fa-picture-o"></i> Media
			</a>
		</li>
		{{-- <li @if($activePage == 'gallery') class="active" @endif>
			<a href="{{route('admin.gallery.index')}}" class="show-tooltip" data-placement="right" title="Gallery">
				<i class="fa fa-picture-o"></i> Gallery
			</a>
		</li> --}}
		<li @if($activePage == 'post') class="active" @endif>
			<a href="{{route('admin.post.index')}}" class="show-tooltip" data-placement="right" title="Posting">
				<i class="fa fa-file-text-o"></i> Posting
			</a>
		</li>
		 <li @if($activePage == 'user') class="active" @endif>
			<a href="{{route('admin.user.index')}}" class="show-tooltip" data-placement="right" title="User">
				<i class="fa fa-users"></i> User
			</a>
		</li>
		<li @if($activePage == 'widget') class="active" @endif>
			<a href="{{route('admin.widget.index')}}" class="show-tooltip" data-placement="right" title="Widget">
				<i class="fa fa-th-large"></i> Widget
			</a>
		</li>
		<li @if($activePage == 'display') class="active" @endif>
			<a href="{{route('admin.display.index')}}" class="show-tooltip" data-placement="right" title="Tampilan">
				<i class="fa fa-laptop"></i> Tampilan
			</a>
		</li>
		<li @if($activePage == 'option') class="active" @endif>
			<a href="{{route('admin.option.web')}}" class="show-tooltip" data-placement="right" title="Atur">
				<i class="fa fa-gears"></i> Atur
			</a>
		</li>
	</ul>
</div>