@section('title') Daftar Media @stop

<script type="text/javascript">
    
</script>

<div class="asmoyo-box">
	<h3 class="box-header">
		<i class="fa fa-picture-o"></i>
		Daftar Media
	</h3>
	<div class="box-content">

		@include('asmoyo::admin.media._menu')

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
		@if($medias['total'])
		@foreach($medias['items'] as $media)
			<div class="col-sm-6 col-md-3">
                <div class="thumbnail asmoyo-media">
                    <div class="image" style="background-image:url('{{getMedia($media['file'])}}');"> &nbsp; </div>
                    <div class="caption hoverable">
                        {{$media['title']}}
                    </div>
                    <div class="action hoverable">
                        <a href="{{ URL::route('admin.media.edit', $media['id']) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        {{ Form::asmoyoLink(
                            ' Hapus',
                            'DELETE',
                            route('admin.media.destroy', $media['id']),
                            array(
                                'class' => 'btn btn-danger btn-sm',
                                'icon'  => 'fa fa-trash-o',
                                'data-placement' => 'right',
                                'title'     => 'right'
                            ),
                            'Apakah anda yakin ?'
                        ) }}
                    </div>
                </div>
            </div>
		@endforeach
		@else
			<h4 class="text-center">Tidak ada data</h4>
		@endif
		</div>

		{{$medias->appends(array('sortir' => $medias['sortir']))->links()}}

	</div>
</div>