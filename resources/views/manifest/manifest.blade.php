@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4">

<blockquote class="blockquote ">
  <p class="m-b-0">
As is your desire, so is your will.
As is your will, so is your deed.
As is your deed, so is your destiny.
  <footer class="blockquote-footer">The Upanishads tr. by <cite title="Source Title">E. Easwaran</cite></footer>

  </p>
</blockquote>		

	</div>
	<div class="col-md-8"><h2>Manifest</h2></div>
</div>

@foreach ($manifests as $manifest)
<div class="row text-muted text-right version">
Verze {{  $manifest->version }}, {{  $manifest->status }}, {{ $manifest->created_at->format('d.m.Y') }}	
</div>
<div class="row container-fluid row-margin manifest">
{!! $manifest->content !!}
</div>
@endforeach

@endsection
