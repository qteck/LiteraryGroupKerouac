@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4">

		<blockquote class="blockquote ">
			<p class="m-b-0">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit.
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
				<td>1</td>
				<td>{{ $tour->date_of_event }}</td>
				<td>{{ $tour->place }}</td>
				<td>{{ $tour->status }}</td>
				<th><a href="{{ url('/')  }}/literarni-tour/{{ $tour->id }}">Zobrazit mapu</a></th>
			</tr>
	   	@endforeach
		</tbody>
	</table>
</div>
@endsection