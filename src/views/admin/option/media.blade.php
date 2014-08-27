@section('title') Pengaturan Media @stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-picture-o"></i>
		Pengaturan Media
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.option._menu')

		{{Form::model($option, array('route' => 'admin.option.mediaSave', 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			<fieldset>
				<legend>1. Images Size</legend>

				<div class="form-group">
					<label for="media_smallSize[w]" class="col-sm-2 control-label">
						Media Small Size
					</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Width (in pixels) :
							</div>
							{{Form::text('media_smallSize[w]', null, array('class' => 'form-control', 'id' => 'media_smallSize[w]'))}}
						</div>
					</div>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Height (in pixels) :
							</div>
							{{Form::text('media_smallSize[h]', null, array('class' => 'form-control', 'id' => 'media_smallSize[h]'))}}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="media_mediumSize[w]" class="col-sm-2 control-label">
						Media Medium Size
					</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Width (in pixels) :
							</div>
							{{Form::text('media_mediumSize[w]', null, array('class' => 'form-control', 'id' => 'media_mediumSize[w]'))}}
						</div>
					</div>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Height (in pixels) :
							</div>
							{{Form::text('media_mediumSize[h]', null, array('class' => 'form-control', 'id' => 'media_mediumSize[h]'))}}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="media_largeSize[w]" class="col-sm-2 control-label">
						Media Large Size
					</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Width (in pixels) :
							</div>
							{{Form::text('media_largeSize[w]', null, array('class' => 'form-control', 'id' => 'media_largeSize[w]'))}}
						</div>
					</div>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Height (in pixels) :
							</div>
							{{Form::text('media_largeSize[h]', null, array('class' => 'form-control', 'id' => 'media_largeSize[h]'))}}
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="media_constraint[aspectRatio]" class="col-sm-2 control-label">
						Web Constraint
					</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Aspect Ratio :
							</div>
							{{Form::checkbox('media_constraint[aspectRatio]', 1, null, array('class' => 'form-control', 'id' => 'media_constraint[aspectRatio]'))}}
						</div>
						<span class="help-block">Menjaga ukuran gambar (W x H) agar tetep sesuai</span>
					</div>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Upsize :
							</div>
							{{Form::checkbox('media_constraint[upsize]', 1, null, array('class' => 'form-control', 'id' => 'media_constraint[upsize]'))}}
						</div>
						<span class="help-block">Menjaga kualitas gambar agar tetep baik</span>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>2. Images Watermark</legend>

				{{-- <div class="form-group">
					<label for="media_watermark[type]" class="col-sm-2 control-label">
						Watermark Type
					</label>
					<div class="col-sm-10">
						{{Form::select('media_watermark[type]', array('text' => 'text', 'image' => 'image'), null, array('class' => 'form-control', 'id' => 'media_watermark[type]'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="media_watermark[text]" class="col-sm-2 control-label">
						Watermark Text
					</label>
					<div class="col-sm-10">
						{{Form::text('media_watermark[text]', null, array('class' => 'form-control', 'id' => 'media_watermark[text]'))}}
					</div>
				</div> --}}

				<div class="form-group">
					<label for="media_imageDefault" class="col-sm-2 control-label">
						Image Default
					</label>
					<div class="col-sm-10">

						{{Form::hidden('media_imageDefault', null, array('id' => 'imageDefaultFieldImage', 'class'=>'form-control'))}}

						<a id="imageDefaultPreview" class="thumbnail" style="margin:0px; height:300px; background:url('{{getMedia($option['media_imageDefault'], 'medium')}}') center no-repeat; background-size:cover; "> </a>

						<a href="{{route('admin.media.ajaxIndex')}}" id="forImageDefault" class="btn btn-default" data-toggle="modal" data-target="#modalAjax">
							<i class="fa fa-picture-o"></i>
							Select Media
						</a>

					</div>
				</div>
				
				<div class="form-group">
					<label for="media_watermark[image]" class="col-sm-2 control-label">
						Watermark Image
					</label>
					<div class="col-sm-10">

						{{Form::hidden('media_watermark[image]', null, array('id' => 'watermarkFieldImage', 'class'=>'form-control'))}}

						<a id="watermarkPreview" class="thumbnail" style="margin:0px; height:300px; background:url('{{getMedia($option['media_watermark']['image'], 'medium')}}') center no-repeat; background-size:cover; "> </a>

						<a href="{{route('admin.media.ajaxIndex')}}" id="forWatermark" class="btn btn-default" data-toggle="modal" data-target="#modalAjax">
							<i class="fa fa-picture-o"></i>
							Select Media
						</a>

					</div>
				</div>
				
				<div class="form-group">
					<label for="media_watermark[position]" class="col-sm-2 control-label">
						Watermark Position
					</label>
					<div class="col-sm-10">
						{{Form::select('media_watermark[position]', $watermarkPositionList, null, array('class' => 'form-control', 'id' => 'media_watermark[position]'))}}
					</div>
				</div>

			</fieldset>

			<hr>
			<div class="form-group">
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
	
	<script type="text/javascript">	

		$( "#forImageDefault" ).asmoyoMediaModal({
			field_file: '#imageDefaultFieldImage',
			preview: '#imageDefaultPreview'
		}, true);

		$( "#forWatermark" ).asmoyoMediaModal({
			field_file: '#watermarkFieldImage',
			preview: '#watermarkPreview'
		}, true);
	</script>
@stop