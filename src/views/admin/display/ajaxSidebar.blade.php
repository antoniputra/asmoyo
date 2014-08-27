@if($containers)
	<div id="handler_{{$position}}" data-url-submit="{{route('admin.display.ajaxSidebar', $position)}}" data-url-delete="{{route('admin.display.ajaxSidebarRemove', $position)}}" data-target="#{{$position}}" > </div>
	{{Form::open(array('method' => 'POST', 'route' => array('admin.display.ajaxSidebarUpdate', $position), 'class' => 'form-horizontal', 'onsubmit' => 'widgetSubmit(\''.$position.'\', this)', 'id' => 'form_'.$position))}}
		{{Form::hidden('position', $position)}}
	<ul class="widget-sortable nav">
		<?php $i = 1; ?>
		@foreach($containers as $key => $c)
			<li>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title" style="position:relative;">
							{{$c['widget'] ?: 'Page'}} : <small>{{$c['title']}}</small>
							<div style="position:absolute; top:-7px; right:0px;">
								<span class="btn btn-default btn-sm handle">
									<i class="fa fa-arrows"></i>
								</span>
								<span class="btn btn-default btn-sm" data-toggle="collapse" data-parent="#accordion" href=".panel_{{$position}}_{{$i}}">
									<i class="fa fa-arrow-down"></i>
								</span>
							</div>
						</h3>
					</div>
					<div class="panel_{{$position}}_{{$i}} panel-collapse collapse">
						<div class="panel-body">
							{{Form::hidden('widget[]', $c['widget'])}}
							<p>
								{{Form::text('title[]', $c['title'], array('class' => 'form-control', 'placeholder' => 'Custom title'))}}
							</p>

							<p>
								@if( isset($c['item']) AND is_array($c['item']) )
									{{Form::select('pseudo[]', $c['item'], $c['content'], array('class' => 'form-control'))}}
									<p>
										<a href="{{route('admin.widget.show', $c['widget'])}}" target="_blank">
											Lihat item &raquo;
										</a>
									</p>
								@else
									{{Form::hidden('pseudo[]', $c['content'])}}
									tidak tersedia item untuk widget ini
								@endif
							</p>

							<!-- btn remove -->
							@if( $c['widget'] )
								<div class="text-right">
									<a class="btn btn-danger btn-sm" data-key="{{$key}}" onclick="widgetRemove('{{$position}}', this)">Hapus</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			</li>
			<?php $i++; ?>
		@endforeach
	</ul>
	<div class="form-group">
		<div class="col-sm-12 text-center">
			<button type="submit" class="btn btn-primary btn-sm">
				<i class="fa fa-check"></i>
				Simpan
			</button>
		</div>
	</div>
	{{Form::close()}}
@else
	<h4 class="text-center">Tidak ada widget</h4>
@endif

<script type="text/javascript">
	// handle sortable
	$( ".widget-sortable" ).sortable({
		revert: true,
		handle: ".handle",
		cursor: "move",
		receive: function(event, ui) {
			// $(this).html('test');
		}
	});

	// handle widget remove
	function widgetRemove(position, that)
	{
		if ( ! confirm('anda yakin ?')) { return false; };

		var handler = $('#handler_{{$position}}'),
			url 	= handler.attr('data-url-submit'),
			urlDelete = handler.attr('data-url-delete'),
			target 	= handler.attr('data-target');

		// delete process
		$( target ).html('loading...');
		$.ajax({
			type: "POST",
			url: urlDelete,
			data: { key: $(that).attr('data-key') }
		})
		.success(function( msg )
		{
			if (msg) {
				$.get(url, function(data,status)
				{
					$( target ).html(data);
				});
			} else {
				alert('error');
			}
		});
		event.preventDefault();
	}

	// handle widget save update
	function widgetSubmit(position, form)
	{
		// console.log('widget submit function called');
		var handler = $('#handler_{{$position}}'),
			url 	= handler.attr('data-url-submit'),
			urlDelete = handler.attr('data-url-delete'),
			target 	= handler.attr('data-target');

		// update process
		$( target ).html('loading...');
		$.ajax({
			type: "POST",
			url: $(form).attr('action'),
			data: $(form).serialize()
		})
		.success(function( msg )
		{
			if (msg) {
				$.get(url, function(data,status)
				{
					$( target ).html(data);
				});
			} else {
				alert('error');
			}
		});
		event.preventDefault();
	}
</script>