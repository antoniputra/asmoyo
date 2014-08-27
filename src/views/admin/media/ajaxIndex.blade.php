<div class="modal-header">
    <a class="close" data-dismiss="modal">
    	<span aria-hidden="true">&times;</span>
    	<span class="sr-only">Close</span>
	</a>
    <h4 class="modal-title" id="mediaModalLabel">Media</h4>
</div>

<div class="modal-body" id="modal_body">
    <div class="row">
	@if($medias['total'])
	@foreach($medias['items'] as $media)
		<div class="col-sm-6 col-md-3">
	        <div class="thumbnail">
	            <a href="#" class="thumbnail media_item" data-id="{{$media['id']}}" data-image="{{$media['file']}}" data-image-url="{{getMedia($media['file'])}}" data-image-url-ori="{{getMedia($media['file'], 'original')}}" style="background:url( {{getMedia($media['file'])}} ) center; background-size: cover; height:170px; margin:0px;" data-dismiss="modal" ></a>
	        </div>
	    </div>
	@endforeach
	@else
		<h4 class="text-center">Tidak ada data</h4>
	@endif
	</div>
	{{--$medias->links()--}}
	<ul class="pagination ajax-pagination">
		{{with(new Antoniputra\Asmoyo\Utilities\Pagination\AjaxPresenter($medias))->render()}}
	</ul>
</div>

<div class="modal-footer">
    <a class="btn btn-default" data-dismiss="modal">Close</a>
</div>

<script type="text/javascript">
	
	$('.media_item').asmoyoMediaModal();
	
	function ajaxPaginationLink(url)
	{
		$('#modal-content').html('<h4 class="text-center"> Memuat... </h4>');
		$.get(url, function(data,status) {
			$('#modal-content').html(data);
			$('#modal-content').slideDown(2000);
		});
	}

</script>