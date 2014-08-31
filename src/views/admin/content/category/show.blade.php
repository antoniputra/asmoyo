@section('title') Kategori {{$cat['title']}} @stop

@section('before_content')
	@include($theme_path .'content.category._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Kategori {{$cat['title']}}
	</h3>
	<div class="box-content">

		<table class="table table-hover">
			<tbody>
				<tr>
					<th>Gambar</th>
					<td> {{$cat['photo']['content']}} </td>
				</tr>
				<tr>
					<th>Title</th>
					<td> {{$cat['title']}} </td>
				</tr>
				<tr>
					<th>Description</th>
					<td> {{$cat['description']}} </td>
				</tr>
			</tbody>
		</table>

	</div>
</div>