@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4">

		<blockquote class="blockquote ">
			<p class="m-b-0">
				Žádný spěch, ani svět jenom masa, velký třesk
			</p>
		</blockquote>		

	</div>
	<div class="col-md-8">
                    <h2>
                            Články

                            @if(!empty($articles->currentMonth))
                            / {{ $articles->currentMonth }}
                            @endif
                    </h2>
            </div>
</div>

<div class="row article-months-margin">
	<div class="col-md-6 margin-sm-device">
		<ul class="article-months">
        @foreach ($months as $month)
			<li>
                @if ($month->articles_count > 0)
                <a href="{{ url('/')  }}/clanky/mesic/{{ $month->id }}">
                @endif
                    {{ $month->month }} ({{ $month->articles_count }})
                @if ( $month->articles_count > 0)
                </a>
                @endif
            </li>
        @endforeach
		</ul>
	</div>
	<div class="col-md-6 margin-sm-device">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco. <a href="">(více)</a> | <a href="">Náhodný článek</a>
	</div>
</div>




@foreach($articles as $article)
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
@endforeach
@endsection