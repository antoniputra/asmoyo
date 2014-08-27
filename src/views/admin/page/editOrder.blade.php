@section('stylesheets')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.css', 'admin')}}
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-arrows-alt"></i>
		Susun Urutan
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.page._menu')
	
		{{Form::open(array('method' => 'PUT', 'route' => 'admin.page.editOrderSave'))}}
			
			<ol id="page-sortir" class="sortable asmoyo-list">
				@if($pages)
					@foreach($pages as $page)
						<li data-id="{{$page['id']}}" data-title="{{$page['title']}}">
							<a style="cursor:move;">
								{{$page['title']}}
							</a>
							@if( $page['child'])
								<ol>
									@foreach($page['child'] as $child)
										<li data-id="{{$child['id']}}" data-title="{{$child['title']}}" data-setparent="0">
											<a style="cursor:move;">
												{{$child['title']}}
											</a>
										</li>
									@endforeach
								</ol>
							@endif
						</li>
					@endforeach
				@endif
			</ol>

			{{Form::textarea('result_sortir', null, array('id'=>'serialize_output', 'style'=>'visibility:hidden; position:absolute;'))}}

			<br><br><br>
			<div class="text-center">
				<button type="submit" class="btn btn-lg btn-primary">
					<i class="fa fa-check"></i>
					Simpan Perubahan
				</button>
			</div>

		{{Form::close()}}

	</div>
</div>

@section('javascripts')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.js', 'admin')}}
	<script type="text/javascript">
		var group = $("#page-sortir").sortable({
			group: 'serialization',
			onDrop: function (item, container, _super) {
				var data = group.sortable("serialize").get();

				var jsonString = JSON.stringify(data, null, ' ');

				$('#serialize_output').text(jsonString);
				_super(item, container);
			}
		});
	</script>
@stop