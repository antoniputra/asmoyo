@section('title') Pengaturan Web @stop

@include('asmoyo::admin.partials.modalAjax')

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-globe"></i>
		Pengaturan Web
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.option._menu')

		{{Form::model($option, array('route' => 'admin.option.webSave', 'method' => 'PUT', 'class' => 'form-horizontal'))}}

			<fieldset>
				<legend>1. Info &amp; System Setting</legend>

				<div class="form-group">
					<label for="web_title" class="col-sm-2 control-label">
						Web Title
					</label>
					<div class="col-sm-10">
						{{Form::text('web_title', null, array('class' => 'form-control', 'id' => 'web_title'))}}
					</div>
				</div>
				
				<div class="form-group">
					<label for="web_logo" class="col-sm-2 control-label">
						Web Logo
					</label>
					<div class="col-sm-10">
						{{Form::hidden('web_logo', null, array('id' => 'web_logo', 'class'=>'form-control'))}}
						
						<a id="web_logo_preview" class="thumbnail" style="margin:0px; height:300px; background:url('{{getMedia($option['web_logo'])}}') center no-repeat; "> </a>

						<a href="{{route('admin.media.ajaxIndex')}}" id="forWebLogo" class="btn btn-default" data-toggle="modal" data-target="#modalAjax">
							<i class="fa fa-picture-o"></i>
							Select Media
						</a>
					</div>
				</div>

				<div class="form-group">
					<label for="web_email" class="col-sm-2 control-label">
						Web Email
					</label>
					<div class="col-sm-10">
						{{Form::text('web_email', null, array('class' => 'form-control', 'id' => 'web_email'))}}
						<span class="help-block">Email untuk website system</span>
					</div>
				</div>
				
				<div class="form-group">
					<label for="web_description" class="col-sm-2 control-label">
						Web Deskripsi
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_description', null, array('class' => 'form-control', 'id' => 'web_description', 'rows' => '5'))}}
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">
						Web Data
					</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Default Item Per Page
							</div>
							{{Form::selectRange('web_itemPerPage', 10, 30, null, array('class' => 'form-control', 'id' => 'web_itemPerPage'))}}
						</div>
					</div>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								Default Sortir
							</div>
							{{Form::select('web_itemSortir', $sortirList, null, array('class' => 'form-control', 'id' => 'web_itemSortir'))}}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="web_description" class="col-sm-2 control-label">
						Web Format Waktu
					</label>
					<div class="col-sm-7">
						{{Form::select('web_dateFormat', $dateFormatList, null, array('class' => 'form-control', 'id' => 'web_dateFormat'))}}
					</div>
				</div>

				<div class="form-group">
					<label for="web_ga" class="col-sm-2 control-label">
						Web Google Analytics
					</label>
					<div class="col-sm-6">
						{{Form::text('web_ga', null, array('class' => 'form-control', 'id' => 'web_ga'))}}
						<span class="help-block">
							Your google-analytics key. eg: UA-xxxxxxxx-x
						</span>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>2. Meta Setting</legend>

				<div class="form-group">
					<label for="web_metaTitle" class="col-sm-2 control-label">
						Meta Title
					</label>
					<div class="col-sm-10">
						{{Form::text('web_metaTitle', null, array('class' => 'form-control', 'id' => 'web_metaTitle'))}}
					</div>
				</div>
				
				<div class="form-group">
					<label for="web_metaKeyword" class="col-sm-2 control-label">
						Meta Keyword
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_metaKeyword', null, array('class' => 'form-control', 'id' => 'web_metaKeyword', 'rows' => '3'))}}
					</div>
				</div>
				
				<div class="form-group">
					<label for="web_metaDescription" class="col-sm-2 control-label">
						Meta Description
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_metaDescription', null, array('class' => 'form-control', 'id' => 'web_metaDescription', 'rows' => '3'))}}
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

@section('javascripts')
	@parent
	<script type="text/javascript">	
		$( "#forWebLogo" ).asmoyoMediaModal({
			field_file: '#web_logo',
			preview: '#web_logo_preview'
		}, true);
	</script>
@stop