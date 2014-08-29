<div class="asmoyo-side-menu" id="mainSide">
	<ul class="nav">
		<li @if($activePage == 'home') class="active" @endif>
			<a href="{{admin_route('home.index')}}" class="show-tooltip" data-placement="right" title="Dashboard">
				<i class="fa fa-home"></i> Dashboard
			</a>
		</li>
		<li @if($activePage == 'page') class="active" @endif>
			<a href="{{admin_route('page.index')}}" class="show-tooltip" data-placement="right" title="Halaman">
				<i class="fa fa-files-o"></i> Halaman
			</a>
		</li>
		<li @if($activePage == 'category') class="active" @endif>
			<a href="{{admin_route('category.index')}}" class="show-tooltip" data-placement="right" title="Kategori">
				<i class="fa fa-tag"></i> Kategori
			</a>
		</li>
		<li @if($activePage == 'media') class="active" @endif>
			<a href="{{admin_route('media.index')}}" class="show-tooltip" data-placement="right" title="Media">
				<i class="fa fa-picture-o"></i> Media
			</a>
		</li>
		<li @if($activePage == 'thread') class="active" @endif>
			<a href="{{admin_route('thread.index')}}" class="show-tooltip" data-placement="right" title="Thread">
				<i class="fa fa-file-text-o"></i> Thread
			</a>
		</li>
		 <li @if($activePage == 'user') class="active" @endif>
			<a href="{{admin_route('user.index')}}" class="show-tooltip" data-placement="right" title="User">
				<i class="fa fa-users"></i> User
			</a>
		</li>
		{{-- <li @if($activePage == 'widget') class="active" @endif>
			<a href="{{admin_route('widget.index')}}" class="show-tooltip" data-placement="right" title="Widget">
				<i class="fa fa-th-large"></i> Widget
			</a>
		</li>
		<li @if($activePage == 'display') class="active" @endif>
			<a href="{{admin_route('display.index')}}" class="show-tooltip" data-placement="right" title="Tampilan">
				<i class="fa fa-laptop"></i> Tampilan
			</a>
		</li> --}}
		<li @if($activePage == 'option') class="active" @endif>
			<a href="{{admin_route('option.index')}}" class="show-tooltip" data-placement="right" title="Atur">
				<i class="fa fa-gears"></i> Atur
			</a>
		</li>
	</ul>
</div>