<div class="row">
	<div class="col-md-4">

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-tag"></i>
				List Kategori
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:category type=list sortir=title-ascending>}' }}
			</div>
		</div>
		
		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-tag"></i>
				Grid Kategori
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:category type=grid sortir=title-descending size=80px>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-tag"></i>
				Media Object Kategori
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:category type=media-object sortir=title-descending>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-tag"></i>
				Detail Kategori
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:category type=detail slug=uncategorized>}' }}
			</div>
		</div>

	</div>
	<div class="col-md-4">

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				List Post
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:post type=list sortir=latest-updated>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				Grid Post
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:post type=grid sortir=title-ascending size=80px>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				Media Object Post
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:post type=media-object sortir=title-ascending>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-file-text-o"></i>
				Detail Post
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:post type=detail id=1>}' }}
			</div>
		</div>

	</div>

	<div class="col-md-4">

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-picture-o"></i>
				List Media
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:media type=list sortir=latest-updated>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-picture-o"></i>
				Grid Media
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:media type=grid sortir=title-ascending size=80px>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-picture-o"></i>
				Media Object Media
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:media type=media-object sortir=title-ascending>}' }}
			</div>
		</div>

		<div class="asmoyo-box">
			<h3 class="box-header">
				<i class="fa fa-picture-o"></i>
				Detail Media
			</h3>
			<div class="box-content">
				{{ '{<asmoyo:media type=detail id=1>}' }}
			</div>
		</div>

	</div>
</div>

@section('sideRight')
	{{--@include('asmoyo::admin.partials.officialInfo')--}}
@stop