@if( count($cat['items']) )
	<div id="bootstrap-banner" class="carousel slide" data-ride="carousel">
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			@foreach($cat['items'] as $key => $item)
				<div class="item @if($key == 0) active @endif ">
					<img src="{{$item['image']}}" style="width:100%; height:300px;" >
					<div class="carousel-caption">
						<h3>{{$item['title']}}</h3>
						<p>{{$item['description']}}</p>
					</div>
				</div>
			@endforeach
		</div>
		<!-- Controls -->
		<a class="left carousel-control" href="#bootstrap-banner" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#bootstrap-banner" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div>
@else
	<h4>Tidak ada item</h4>
@endif