@section('javascripts')

	<!-- Modal -->
	<div class="modal fade" id="modalAjax" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" id="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="mediaModalLabel">Modal title</h4>
				</div>
				<div class="modal-body" id="modal_body">
					Memuat...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
				</div>
			</div>
		</div>
	</div>

	@parent

	<script type="text/javascript">
		$('body').on('hidden.bs.modal', '.modal', function () {
			$(this).removeData('bs.modal');
		});
	</script>
	
@stop