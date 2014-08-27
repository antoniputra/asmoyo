@section('title') {{$title}} @stop

@include('asmoyo::admin.partials.confFroala')

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-th-large"></i>
		Edit {{$widget['item']['title']}} - (widget: {{$widget['title']}})
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.widget._menu')

		{{Form::model($widget['item'], array('method' => 'PUT', 'url' => route('admin.widget.item.update', array($widget['slug'], $widget['item']['id'])), 'class' => 'form-horizontal'))}}
			
			{{Form::hidden('widget_id', $widget['id'])}}

			<fieldset>
				<legend>Info</legend>
				<div class="form-group">
					<label class="control-label col-md-2">
						Title
					</label>
					<div class="col-md-10">
						{{Form::text('title', null, array('class' => 'form-control', 'required' => 'true'))}}
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2">
						Description
					</label>
					<div class="col-md-10">
						{{Form::textarea('description', null, array('class' => 'form-control', 'rows' => '3', 'required' => 'true'))}}
					</div>
				</div>

				<legend>Content</legend>
				<div class="form-group">
					<label class="control-label col-md-2">
						Text
					</label>
					<div class="col-md-10">
						{{Form::textarea('content[text]', $content['text'], array('class' => 'form-control froala_editor', 'rows' => '5'))}}
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
					</div>
				</div>
			</fieldset>

		{{Form::close()}}

	</div>
</div>