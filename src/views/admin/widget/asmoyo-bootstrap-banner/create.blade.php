@section('title') Tambah Grup Widget {{$widget['title']}} @stop

@section('stylesheets')
	@parent
	{{asmoyoAsset( 'plugin/sortable/jquery-sortable.css', 'admin')}}
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Edit Widget Grup {{$widget['group']['title']}} - Widget {{$widget['title']}}
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
								<i class="fa fa-pencil"></i>
								Edit Identitas Widget Grup
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
			<ol id="widgetSortir" class="sortable asmoyo-widget-sortir">
			@for($i=1; $i<=5; $i++)
				<li id="item_{{$i}}">
					<i id="btn-move" class="fa fa-arrows moveable"></i>
					<!-- <a class="btn btn-default btnRemove" onclick="removeRow({{$i}})">
						Remove
					</a> -->
					<div class="form-group">
						<label class="col-sm-2 control-label">
							Gambar
						</label>
						<div class="col-sm-10">
							{{Form::hidden( 'content[file][]', null, array('id' => 'file_'.$i) )}}
							
							<a id="preview_{{$i}}" class="thumbnail" style="margin:0px; height:300px; background:url('{{null}}') center no-repeat; "> </a>

							<a href="{{route('admin.media.ajaxIndex')}}" id="caller_{{$i}}" class="btn btn-default" data-toggle="modal" data-target="#modalAjax">
								<i class="fa fa-picture-o"></i>
								Select Media
							</a>
						</div>
					</div>
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
						<i class="fa fa-check"></i>
						Simpan Perubahan
					</button>
				</div>
			</div>

		{{Form::close()}}

	</div>
</div>

@include('asmoyo::admin.partials.modalAjax')

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

		// remove row
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

		@for($i=1; $i<=5; $i++)

			// media modal
			$( "#caller_{{$i}}" ).asmoyoMediaModal({
				field_file_url: '#file_{{$i}}',
				preview: '#preview_{{$i}}'
			}, true);
		@endfor
	</script>
@stop