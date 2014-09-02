@section('title') Daftar Media @stop

@section('before_content')
	@include($theme_path .'content.media._menu')
@stop

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-tag"></i>
		Daftar Media
	</h3>
	<div class="box-content">

		<ul class="nav nav-pills">
			<li class="disabled">
				<a>Total Data : <b>{{$medias['total']}}</b></a>
			</li>
			<li class="disabled">
				<a>Sortir by : <b>{{$medias['sortir']}}</b></a>
			</li>
			<li class="disabled">
				<a>Status by : <b>{{$medias['status']}}</b></a>
			</li>
		</ul>

		<div class="row">
		@if($medias['items'])
		@foreach($medias['items'] as $med)
			<div class="col-sm-6 col-md-3">
                <div class="thumbnail asmoyo-media">
                    <div class="image" style="background-image:url('{{ getThumb($med['content']) }}');"> &nbsp; </div>
                    <div class="caption hoverable">
                        {{$med['title']}}
                    </div>
                    <div class="action hoverable">
                        <a href="{{ admin_route('media.edit', $med['id']) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        {{ Form::link(
                            ' Hapus',
                            'DELETE',
                            admin_route('media.forceDestroy', $med['id']),
                            array(
                                'class' => 'btn btn-danger btn-sm',
                                'icon'  => 'fa fa-trash-o',
                            ),
                            'Apakah anda yakin ?'
                        ) }}
                    </div>
                </div>
            </div>
		@endforeach
		@else
			<tr>
				<td colspan="3">
					<h4>Tidak ada data</h4>
				</td>
			</tr>
		@endif

		{{$medias->appends(array('sortir' => $medias['sortir'], 'status' => $medias['status']))->links()}}

	</div>
</div>