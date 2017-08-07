@extends('layout')

@section('content')
<div class="row row-margin">

    <div class="col-sm-4 grid4">
        <div class="row">
            <div class="container-fluid">
                <strong>{{ $article->created_at->format('d.m.Y') }} <br> {{ $article->place }}</strong>
            </div>
        </div>
        <hr class="divider">

        <div class="row">
            <div class="container-fluid">
                <strong>Obsah ve stručnosti</strong>
                <p>
                {{ $article->content_in_brief }}
                </p>
            </div>
        </div>
        <hr class="divider">
        
        @if (!empty($article->music))
        <div class="row">
            <div class="container-fluid">
                <strong>Doporučený poslech</strong>
                <iframe
                accesskey="" src="{{ $article->music }}">
            </iframe>
            </div>
        </div>
        <hr class="divider">
        @endif

        @if (count($article->sources) > 0)
        <div class="row">
            <div class="container-fluid">
                <strong>Spojení</strong>
                <ul>
                    @foreach ($article->sources as $source)
                    <li>{!! $source->source !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif  
    </div>

    <div class="col-sm-8 grid8 margin-as-fuck">
        <h2>                
        	{{ $article->title }}
        </h2>

        {!! $article->content !!}
    </div>
</div>

@endsection