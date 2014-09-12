@section('title')
	{{ $title }}
@stop

@section('javascripts')
	@parent
	{{ HTML::script('/packages/antoniputra/asmoyo/admin/js/asmoyo-list.js') }}

	<script type="text/javascript">
		$("#web_owner").asmoyolist();
		$("#web_contact").asmoyolist();
		$("#web_facebook").asmoyolist();
		$("#web_twitter").asmoyolist();
	</script>
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-globe"></i>
		{{ $title }}
	</h3>
	<div class="box-content">

		{{Form::model($option, array('url' => admin_route('option.putWeb'), 'method' => 'PUT', 'class' => 'form-horizontal'))}}

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
						{{Form::text('web_logo', $option['web_logo'], array('id' => 'web_logo', 'class'=>'form-control'))}}
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
					<label for="web_location" class="col-sm-2 control-label">
						Lokasi
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_location', null, array('class' => 'form-control', 'id' => 'web_location', 'rows' => 4))}}
						<span class="help-block">Lokasi kantor anda</span>
					</div>
				</div>

				<div class="form-group">
					<label for="web_address" class="col-sm-2 control-label">
						Alamat
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_address', null, array('class' => 'form-control', 'id' => 'web_address', 'rows' => 4))}}
						<span class="help-block">Alamat kantor anda</span>
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
					<label for="web_contact" class="col-sm-2 control-label">
						Web Contact
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_contact', json_encode($option['web_contact']), array(
							'class' 	=> 'form-control',
							'id' 		=> 'web_contact',
							'data-fields' => '{"name":"text", "value":"textarea"}'
						))}}
					</div>
				</div>
				
				<div class="form-group">
					<label for="web_owner" class="col-sm-2 control-label">
						Web Owner
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_owner', json_encode($option['web_owner']), array(
							'class' 		=> 'form-control',
							'id' 			=> 'web_owner',
							'data-fields' 	=> '{"name":"text", "email":"text", "description":"textarea"}'
						))}}
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>2. Social Setting</legend>

				<div class="form-group">
					<label for="" class="col-sm-2 control-label">
						Web Facebook
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_facebook', json_encode($option['web_facebook']), array(
							'class' 		=> 'form-control',
							'id' 			=> 'web_facebook',
							'data-fields' 	=> '{"url":"text"}'
						))}}
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-2 control-label">
						Web Twitter
					</label>
					<div class="col-sm-10">
						{{Form::textarea('web_twitter', json_encode($option['web_twitter']), array(
							'class' 		=> 'form-control',
							'id' 			=> 'web_twitter',
							'data-fields' 	=> '{"url":"text"}'
						))}}
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend>3. Meta Setting</legend>

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