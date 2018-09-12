@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-4">

        <blockquote class="blockquote ">
            <p class="m-b-0">
                I think good dreaming is what leads to good photographs.
                                <footer class="blockquote-footer"><cite title="Source Title">Wayne Miller</cite></footer>
            </p>
                </blockquote>       

    </div>
    <div class="col-md-8"><h2>Galerie: {{ $photos->title }}</h2></div>
</div>


<div class="row">
<div class="container-fluid row-margin">
    
    <div class="picture" style="" itemscope itemtype="http://schema.org/ImageGallery">
        @foreach ($photos->photos as $photo)
 
            <figure style="float: left;margin-right: 1%; margin-bottom: 0.5em;"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a href="{{ asset('/storage/'. $photo->title) }}" itemprop="contentUrl" data-size="1000x667" data-index="1">
                    <img src="{{ asset('/storage/'. $photo->title) }}" style="height: 200px;" class="img-responsive"itemrop="thumbnail" alt="">
                </a>
            </figure>
        
        @endforeach
    </div>
      
</div>
</div>


</div>
@endsection