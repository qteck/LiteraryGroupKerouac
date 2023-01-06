@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4">

		<blockquote class="blockquote ">
			<p class="m-b-0">
				Everything depends upon execution; having just a vision is no solution.
				<footer class="blockquote-footer"><cite title="Source Title">Stephen Sondheim</cite></footer>
			</p>
		</blockquote>		

	</div>
	<div class="col-md-8"><h2>{{ $tour->title }}</h2></div>
</div>

<div class="container-fluid">
<div class="row row-margin">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Datum</th>
				<th>Místo</th>
				<th>Cena</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><span class="glyphicon glyphicon-star"></span></td>
				<td>{{ $tour->date_of_event }}</td>
				<td>{{ $tour->place }}</td>
				<th>{{ $tour->price}} kč</th>
				<td>{{ $tour->status }}</td>
			</tr>
		</tbody>
	</table>
	<iframe src="{{ $tour->map_url }}" style="width: 100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>

@endsection