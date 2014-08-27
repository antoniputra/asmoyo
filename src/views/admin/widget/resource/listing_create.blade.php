@section('title') {{$title}} @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Buat Item - (widget: {{$widget['title']}})
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		{{Form::open(array('route' => array('admin.widget.item.store', $widget['slug']), 'class' => 'form-horizontal'))}}

			{{Form::hidden('widget_id', $widget['id'])}}
			{{Form::hidden('is_multiple_item', 1)}}

			<fieldset>
				<legend>Info</legend>
				<div class="form-group">
					<label class="control-label col-md-2">
						Title
					</label>
					<div class="col-md-10">
						{{Form::text('title', null, array('class' => 'form-control', 'required' => 'true'))}}
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">
						Description
					</label>
					<div class="col-md-10">
						{{Form::textarea('description', null, array('class' => 'form-control', 'rows' => '3', 'required' => 'true'))}}
					</div>
				</div>

				<legend>Content</legend>
				<ol id="widgetSortir" class="sortable asmoyo-widget-sortir">
					@for($i=0; $i<10; $i++)
					<li id="item_{{$i}}">
						<i id="btn-move" class="fa fa-arrows moveable"></i>
						<a class="btn btn-default btnRemove" onclick="removeRow({{$i}})">
							Remove
						</a>
						<div class="form-group">
							<label class="col-md-2 control-label">
								Title
							</label>
							<div class="col-md-9">
								{{Form::text('content[title][]', null, array('class' => 'form-control'))}}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">
								Link
							</label>
							<div class="col-md-9">
								{{Form::text('content[link][]', null, array('class' => 'form-control'))}}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">
								Description
							</label>
							<div class="col-md-9">
								{{Form::textarea('content[description][]', null, array('class' => 'form-control', 'rows' => '3'))}}
							</div>
						</div>
						<hr style="border-color:#999;">
					</li>
					@endfor
				</ol>

				<div class="form-group" id="bottom">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
					</div>
				</div>
			</fieldset>

		{{Form::close()}}

	</div>
</div>

@section('stylesheets')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.css', 'admin')}}
@stop

@section('javascripts')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.js', 'admin')}}
	<script type="text/javascript">
		// sortable
		var group = $("#widgetSortir").sortable({
			group: 'serialization',
			handle: '#btn-move',
			onDrop: function (item, container, _super)
			{
				_super(item, container);
			}
		});

		var itemTotal = $('#widgetSortir li').length;

		// add field
		/*function addRow() {
			itemTotal++;
			$('#item_clone li').attr("id", "item_"+itemTotal);
			var newLine  = $('#item_clone li').clone();
			newLine.find('.btnRemove').attr('onclick', 'removeRow('+itemTotal+')');
			$('#widgetSortir').append(newLine);
		}*/

		function removeRow(num) {
			if(confirm('anda yakin ?'))
			{
				if (itemTotal > 1) {
					$( '#item_'+num ).remove();
					itemTotal--;
					return true;
				} else {
					alert('anda tidak bisa menghilangkan semua');
					return false;
				}

			}
		}
	</script>
@stop