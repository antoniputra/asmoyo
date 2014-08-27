@section('title') Tampilan @stop

<div class="row">
	<div class="col-md-8">
		<div class="asmoyo-box" style="background:none;">
			<h3 class="box-header">
				<i class="fa fa-laptop"></i>
				Atur Tampilan
			</h3>
			<div class="box-content">
				<h4>Daftar Widget &raquo;</h4>
				<div class="row">
					<div class="col-md-12">
						@foreach($widgets['items'] as $w)
							<div class="asmoyo-widget-list panel panel-default pull-left">
								<div class="panel-heading">
									<h4 class="panel-title">
										{{$w['title']}}
									</h4>
								</div>
								<div class="panel-body">
									{{$w['description']}}
								</div>
								<div class="panel-footer">
									<div class="dropdown pull-right">
										<a data-toggle="dropdown" class="btn btn-sm btn-primary">
											<i class="fa fa-plus"></i> Add
										</a>
										<ul class="dropdown-menu widget-chooser">
											@foreach ($widgetContainer as $wc)
												<li>
													<a style="cursor:pointer;" data-target="{{$wc['id']}}" data-widget="{{$w['slug']}}" data-value="{<asmoyo:widget name={{$w['slug']}} item=0>}" data-title="">
														{{$wc['title']}}
													</a>
												</li>
											@endforeach
										</ul>
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
						@endforeach
					</div>
				</div> <!-- End Row -->

			</div>
		</div>
	</div>

	<div class="col-md-4">
		@foreach($widgetContainer as $wc)
			<div class="asmoyo-box">
				<h3 class="box-header">
					{{$wc['title']}}
				</h3>
				<div class="box-content" id="{{$wc['id']}}">
					<!-- ajax content -->
				</div>
			</div>
		@endforeach
	</div>
</div>

@section('javascripts')
	@parent
	{{HTML::script('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js')}}
	<script type="text/javascript">
		$(function() {
			/*
			// load side left
			$( '#left' ).html('loading...');
			$.get("{{route('admin.display.ajaxSidebar', 'left')}}", function(data,status)
			{
				$( '#left' ).html(data);
			});

			// load side right
			$( '#right' ).html('loading...');
			$.get("{{route('admin.display.ajaxSidebar', 'right')}}", function(data,status)
			{
				$( '#right' ).html(data);
			});
			*/

			/* Load Available Container */
			@foreach($widgetContainer as $wc)

				$( "#{{ $wc['id'] }}" ).html("loading...");
				$.get("{{route('admin.display.ajaxSidebar', $wc['id'])}}", function(data,status)
				{
					$( "#{{ $wc['id'] }}" ).html(data);
				});

			@endforeach

			/* Insert Process */
			$('.widget-chooser > li > a').click(function(){
				// initialize variable
				var el 		= $(this),
					target 	= '#'+ el.attr('data-target'),
					title 	= el.attr('data-title'),
					widget 	= el.attr('data-widget'),
					content	= el.attr('data-value');

				if(target == '#right')
				{
					var urlPost = "{{route('admin.display.ajaxSidebarAdd', 'right')}}",
						url 	= "{{route('admin.display.ajaxSidebar', 'right')}}";
				} else if(target == '#left') {
					var urlPost = "{{route('admin.display.ajaxSidebarAdd', 'left')}}",
						url 	= "{{route('admin.display.ajaxSidebar', 'left')}}";
				} else {
					var urlPost = "{{route('admin.display.ajaxSidebarAdd', '')}}/"+ target.replace('#', ''),
						url 	= "{{route('admin.display.ajaxSidebar', '')}}/"+ target.replace('#', '');
				}

				// add proses
				$( target ).html('loading...');
				$.ajax({
					type: "POST",
					url: urlPost,
					data: { title: title, widget: widget, content: content }
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

				/*$.get(url, function(data,status)
				{
					$( target ).html(data);
				});*/
			});

			/*$( ".widget-draggable li" ).draggable({
				connectToSortable: ".widget-sortable",
				helper: "clone",
				revert: "invalid",
				cursor: "move",
				start: function( event, ui ) {
					$('.widget-sortable').append('<li class="placeholder"> Place Here </li>');
				},
				stop: function( event, ui ) {
					$('.widget-sortable .placeholder').remove();
				}
			});*/
		});
	</script>
@stop