@section('title') Daftar Widget @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Daftar Widget
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$widgets->getTotal()}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$widgets['sortir']}}</b></a>
			</li>
		</ul>

		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width:40px;"> No. </th>
					<th> Title </th>
					<th> Support </th>
					<th> Opsi </th>
				</tr>
			</thead>
			<tbody>
				@if($widgets['items'])
				@foreach($widgets['items'] as $widget)
					<tr>
						<td> {{$itemNumber++}} </td>
						<td>
							{{$widget['title']}}
							<p><small>{{$widget['description']}}</small></p>
						</td>
						<td>
							{{$widget['supported']}}
						</td>
						<td>
							@if($widget['has_item'])
								<a href="{{route('admin.widget.show', $widget['slug'])}}" class="btn btn-default btn-sm">
									<i class="fa fa-gear"></i>
									Kelola
								</a>
							@else
								-
							@endif
						</td>
					</tr>
				@endforeach
				@else
					<tr>
						<td colspan="3">
							<h4>Tidak ada data</h4>
						</td>
					</tr>
				@endif
			</tbody>
		</table>

		{{$widgets->appends(array('sortir' => $widgets['sortir']))->links()}}

	</div>
</div>