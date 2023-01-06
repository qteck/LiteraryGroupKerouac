@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4">

		<blockquote class="blockquote ">
			<p class="m-b-0">
				There are always two people in every picture: the photographer and the viewer.
                                <footer class="blockquote-footer"><cite title="Source Title">Ansel Adams</cite></footer>
			</p>
                </blockquote>		

	</div>
	<div class="col-md-8"><h2>Galerie</h2></div>
</div>

<div class="row">
<div class="container-fluid row-margin">
        @foreach($galleries as $gallery)
	<div class="col-lg-3 col-md-4 col-xs-6 img-padding">
		<div class="thumbnail-border">
			<a href="{{ url('/') }}/galerie-prohlidka/{{ $gallery->id }}">
                            <img class="img-responsive" 
                            src="@if(!empty($gallery->photos->first()->title)){{ asset('/storage/'. $gallery->photos->first()->title) }}@else{{ asset('/storage/0') }}@endif">
			</a>
			<div class="img-description">{{ $gallery->title }}</div>
		</div>
	</div>
        @endforeach
</div>
    </div>
@endsection