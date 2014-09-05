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

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-th-large"></i>
						Widgets <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						@if( $preferenceList = app('asmoyo.option.preference') )
						@foreach($preferenceList as $name => $value)
							<li>
								<a href="{{admin_route('preference.data.index', $name)}}">
									{{$value['title']}}
								</a>
							</li>
						@endforeach
						@endif
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user"></i>
						{{$auth['username']}} <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{admin_route('user.getChangePassword')}}">
								Edit Password
							</a>
						</li>
						<li class="divider"> </li>
						<li>
							<a href="{{admin_route('logout')}}">
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>  <!-- End Collapse -->
	</div>
</div>