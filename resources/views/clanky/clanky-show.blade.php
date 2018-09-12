@extends('layout')

@section('content')
<div class="row row-margin">
    <div class="col-sm-12 grid8 margin-as-fuck">
        <h2 style="text-align: center;">
            <a href="{{ url('/')  }}/clanek/{{ $article->id }}">
                {{ $article->title }}
            </a>
        </h2>
        <hr class="divider">
               <div class="row">
            <div class="container-fluid">
                <strong>{{ $article->created_at->format('d.m.Y') }}, {{ $article->place }}</strong>
            </div>
        </div>

        {!! $article->content !!}
    </div>
</div>

@endsection