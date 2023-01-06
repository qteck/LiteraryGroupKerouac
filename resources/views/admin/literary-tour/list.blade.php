@extends('/admin/layout') 

@section('content_admin')
  <h1>List of events</h1>

<div class="table-responsive row-margin">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Datum</th>
				<th>Místo</th>
				<th>Status</th>
				<th>Status</th>
				<th>#</th>
				<th>#</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($listOfEvents as $tour)
			<tr>
				<td>{{ $listOfEvents->count-- }}</td>
				<td>{{ $tour->date_of_event }}</td>
				<td>{{ $tour->place }}</td>
				<td>{{ $tour->status }}</td>
				<td><a href="{{ url('/literarni-tour/'.$tour->id) }}">Zobrazit mapu</a></td>
				<td><a href="{{ url('/literarni-tour/'.$tour->id) }}"><span class="glyphicon glyphicon-link"></span></a></td>
				<td><a href="{{ url('/literarni-tour/edit/'.$tour->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
				<td><a href="{{ url('/literarni-tour/delete/'.$tour->id) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
	   	@endforeach
		</tbody>
	</table>
</div>


@endsection