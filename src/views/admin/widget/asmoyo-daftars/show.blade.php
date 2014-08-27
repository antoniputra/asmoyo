<div class="modal-header">
    <a class="close" data-dismiss="modal">
    	<span aria-hidden="true">&times;</span>
    	<span class="sr-only">Close</span>
	</a>
    <h4 class="modal-title" id="mediaModalLabel">
    	Widget <b> {{$widget['title']}} </b> : {{$widget['group']['title']}}
    </h4>
</div>

<div class="modal-body" id="modal_body">
    <div class="list-group">
    	@if($widget['group']['content'])
    	@foreach($widget['group']['content'] as $content)
    		<a @if($content['link']) href="{{$content['link']}}" @endif class="list-group-item">
				<h4 class="list-group-item-heading">
					{{$content['title']}}
				</h4>
				<p class="list-group-item-text">
    				{{$content['description']}}
    			</p>
				
				@if($content['link'])
					<span class="badge">
						Buka &raquo;
					</span> <br>
				@endif
			</a>
		@endforeach
		@endif
	</div>
</div>

<div class="modal-footer">
	<a href="{{route('admin.widget.group.edit', array($widget['slug'], $widget['group']['slug']) )}}" class="btn btn-primary">
		Edit
	</a>
    <a class="btn btn-default" data-dismiss="modal">Close</a>
</div>