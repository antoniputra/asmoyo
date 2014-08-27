@section('title') Edit Media : {{$media['title']}} @stop

@include('asmoyo::admin.media._upload')
@section('javascripts')
	@parent
	<script type="text/javascript">
		// generate slug
		$('#title').asmoyoHelper();
	</script>
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-picture-o"></i>
		Edit Media : {{$media['title']}}
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.media._menu')

		{{ Form::model($media, array(
            'method'    => 'PUT',
            'url'       => route('admin.media.update', $media['id']),
            'class'     => 'form-horizontal',
            'id'        => 'dropzone',
            'files'     => true
        )) }}

        	{{Form::hidden('id', null)}}
        	{{Form::hidden('type', null)}}
        	{{Form::hidden('fileName', $media['file'])}}

        	<div class="form-group">
				<label for="title" class="col-sm-2 control-label">
					Gambar
				</label>
				<div class="col-sm-9">
					<a class="thumbnail" style="display:inline-block; margin:0px;">
						<img src="{{getMedia($media['file'])}}">
					</a>
					<div>
						<a class="btn btn-primary" data-toggle="modal" data-target="#myModal">
							Buka ukuran gambar
						</a>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">
					Title
				</label>
				<div class="col-sm-9">
					{{Form::text('title', null, array('class' => 'form-control', 'id' => 'title', 'asmoyo-helper' => 'GenerateSlug', 'placeholder' => 'Title'))}}
				</div>
			</div>

			<div class="form-group">
				<label for="slug" class="col-sm-2 control-label">
					Slug
				</label>
				<div class="col-sm-9">
					<div class="input-group">
						<div class="input-group-addon">
							{{route('admin.media.index')}}
						</div>
						{{Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug', 'placeholder' => 'slug'))}}
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="status" class="col-sm-2 control-label">
					Status
				</label>
				<div class="col-sm-9">
					{{Form::select('status', $statusList, null, array('class' => 'form-control', 'id' => 'status', 'placeholder' => 'status'))}}
				</div>
			</div>

        	<div class="form-group">
				<label for="description" class="col-sm-2 control-label">
					Description
				</label>
				<div class="col-sm-9">
					{{Form::textarea('description', null, array('class' => 'form-control', 'id' => 'description', 'placeholder' => 'Description', 'rows'=>'4'))}}
				</div>
			</div>

			<hr>

        	<div class="form-group">
        		<label for="title" class="col-sm-2 control-label">
					
				</label>
				<div class="col-sm-9">
		        	<div class="checkbox">
						<label>
							{{Form::checkbox('withWatermark', 1, null)}}
							<b>Watermark</b>
						</label>
					</div>
					<div class="checkbox">
						<label>
							{{Form::hidden('withUpsize', 0)}}
							{{Form::checkbox('withUpsize', 1, $web['media_constraint']['upsize'])}}
							<b>Upsize</b> (Menjaga ukuran gambar ketika diperbesar, agar tetap baik)
						</label>
					</div>
					<div class="checkbox">
						<label>
							{{Form::hidden('withAspectRatio', 0)}}
							{{Form::checkbox('withAspectRatio', 1, $web['media_constraint']['aspectRatio'])}}
							<b>Aspect Ratio</b> (Menjaga ukuran gambar (W x H) agar tetep sesuai)
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">
					Ganti Gambar
				</label>
				<div class="col-sm-9">
		        	<a id="uploadBtn" class="btn btn-success">
		        		<i class="fa fa-picture-o"></i> Change Image &amp; Save Change
		        	</a>
	        	</div>
        	</div>

        	<br>
        	<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
	    			<button type="submit" class="btn btn-primary">
						Simpan Perubahan tanpa mengubah gambar
					</button>
				</div>
        	</div>

        	<div id="uploadPreview" class="dropzone" style="min-height:100px;"></div>

        {{ Form::close() }}

	</div>
</div>

<!-- Modal Media Size -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</a>
				<h4 class="modal-title" id="myModalLabel">Ukuran Gambar</h4>
			</div>
			<div class="modal-body">
				<p>
					<div>Small</div>
					<a class="thumbnail" style="display:inline-block;">
						<img src="{{getMedia($media['file'], 'small')}}">
					</a>
				</p>
				<p>
					<div>Medium</div>
					<a class="thumbnail" style="display:inline-block;">
						<img src="{{getMedia($media['file'], 'medium')}}">
					</a>
				</p>
				<p>
					<div>Large</div>
					<a class="thumbnail" style="display:inline-block;">
						<img src="{{getMedia($media['file'], 'large')}}">
					</a>
				</p>
				<p>
					<div>Original</div>
					<a class="thumbnail" style="display:inline-block;">
						<img src="{{getMedia($media['file'], 'original')}}">
					</a>
				</p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-info" data-dismiss="modal">Close</a>
			</div>
		</div>
	</div>
</div>