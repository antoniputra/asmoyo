@section('title')
	{{ $title }}
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-globe"></i>
		{{ $title }}
	</h3>
	<div class="box-content">

		{{Form::model($media, array('url' => admin_route('option.putMedia'), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			<fieldset>
				<div class="form-group">
					<label for="media_imageWatermark" class="col-sm-2 control-label">
						Watermark
					</label>
					<div class="col-sm-10">
						{{Form::text('media_imageWatermark', null, array('class' => 'form-control', 'id' => 'media_imageWatermark'))}}
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">
						Thumbnail Size
					</label>
					<div class="col-sm-10">
						<div class="col-md-6">
							<label>Width : </label>
							{{Form::text('media_imageThumbnail[width]', null, array('class' => 'form-control', 'id' => 'media_imageThumbnail[width]'))}}
						</div>
						<div class="col-md-6">
							<label>Height : </label>
							{{Form::text('media_imageThumbnail[height]', null, array('class' => 'form-control', 'id' => 'media_imageThumbnail[height]'))}}
						</div>
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