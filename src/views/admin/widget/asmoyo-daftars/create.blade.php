@section('title') Tambah Widget Grup @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Tambah Widget Grup
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		{{Form::open(array('url' => route('admin.widget.group.store', array($widget['slug'])), 'method' => 'POST', 'class' => 'form-horizontal'))}}

			{{Form::hidden('widget_id', $widget['id'])}}

			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<h4 class="panel-title">
								<i class="fa fa-info-circle"></i>
								Identitas Widget Grup
							</h4>
						</a>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-2 control-label">
									Title
								</label>
								<div class="col-md-9">
									{{Form::text('title', null, array('class' => 'form-control'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">
									Type
								</label>
								<div class="col-md-9">
									{{Form::select('type', $typeList, null, array('class' => 'form-control'))}}
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">
									Description
								</label>
								<div class="col-md-9">
									{{Form::textarea('description', null, array('class' => 'form-control', 'rows' => 4))}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<p class="lead">
				<a href="#bottom" class="btn btn-default" onclick="addRow()">
					<i class="fa fa-plus"></i>
					Tambahkan Baris
				</a>
			</p>

			<ol id="widgetSortir" class="sortable asmoyo-widget-sortir">
				<?php $i = 1; ?>
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
			</ol>

			<div class="form-group" id="bottom">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Simpan Perubahan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>

<!-- Clone Data -->
<div id="item_clone" style="display:none;">
	<li id="">
		<i id="btn-move" class="fa fa-arrows moveable"></i>
		<a class="btn btn-default btnRemove" onclick="">
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
</div>
<!-- End Clone Data -->


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
		function addRow() {
			itemTotal++;
			$('#item_clone li').attr("id", "item_"+itemTotal);
			var newLine  = $('#item_clone li').clone();
			newLine.find('.btnRemove').attr('onclick', 'removeRow('+itemTotal+')');
			$('#widgetSortir').append(newLine);
		}

		function removeRow(num) {
			if(confirm('anda yakin ?'))
			{
				if( itemTotal > 1 ) {
					$( '#item_'+num ).remove();
					itemTotal--;
				} else {
					alert('anda tidak bisa menghilangkan semua item'); 
					return false;
				}
			}
		}
	</script>
@stop