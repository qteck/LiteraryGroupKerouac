@extends('layout')

@section('content')

<div class="row row-margin">

    <div class="col-sm-4 grid4">
        <div class="row">
            <div class="container-fluid">
                <strong>{{ $photos->created_at->format('d.m.Y') }}  <br> {{ $photos->place }}</strong>
            </div>
        </div>
        <hr class="divider">

        <div class="row">
            <div class="container-fluid">
                <strong>Obsah ve stručnosti</strong>
                <p>
                {{ $photos->content_in_brief }}
                </p>
            </div>
        </div>
        <hr class="divider">
        
        @if (!empty($photos->music))
        <div class="row">
            <div class="container-fluid">
                <strong>Doporučený poslech</strong>
                <iframe
                accesskey="" src="{{ $photos->music }}">
            </iframe>
            </div>
        </div>
        <hr class="divider">
        @endif
    </div>



<div class="col-sm-8 grid8 margin-as-fuck">
    <h2>{{ $photos->title }}</h2>
    
    
    <div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
        @foreach ($photos->photos as $photo)
 
            <figure class="col-lg-3 col-md-4 col-xs-6 img-padding" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a href="{{ asset('/storage/'. $photo->title) }}" itemprop="contentUrl" data-size="1000x667" data-index="1">
                    <img src="{{ asset('/storage/'. $photo->title) }}" class="img-responsive" height="400" width="600" itemprop="thumbnail" alt="">
                </a>
            </figure>
        
        @endforeach
    </div>
      
</div>


</div>
@endsection