@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4">

<blockquote class="blockquote ">
  <p class="m-b-0">
Success is not final, failure is not fatal: it is the courage to continue that counts.
  <footer class="blockquote-footer"><cite title="Source Title">Winston Churchill</cite></footer>

  </p>
</blockquote>	

	</div>
	<div class="col-md-8"><h2>Literární tour</h2></div>
</div>

<div class="table-responsive row-margin">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Datum</th>
				<th>Místo</th>
				<th>Status</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($tours as $tour)
			<tr>
				<td><span class="glyphicon glyphicon-star"></span></td>
				<td>{{ $tour->date_of_event }}</td>
				<td>{{ $tour->place }}</td>
				<td>{{ $tour->status }}</td>
				<th><a href="{{ url('/')  }}/literarni-tour/{{ $tour->id }}">Zobrazit mapu</a></th>
			</tr>
	   	@endforeach
		</tbody>
	</table>
	<p>Máte-li zájem o čtení Slavné literární skupiny Kerouac, kontaktujte nás na adrese info@kerouac.cz.</p>
</div>
@endsection