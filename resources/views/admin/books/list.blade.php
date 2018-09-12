@extends('/admin/layout') 

@section('content_admin')
<h1>List of Books</h1>
@foreach($errors as $error)
{{ $error }}
@endforeach
<div class="table-responsive">
<table class="table table-striped">
 	<thead>
 		<tr>
 			<th>Created</th>
 			<th>Title</th>
 			<th>Description</th>
 			<th>Author</th>
 			<th>Price</th>
 			<th>#</th>
 			<th>#</th>
 		</tr>
 	</thead>
 	    <tbody>
	@foreach($books as $book)
		<tr>
		<td>{{  $book->created_at->format('d.m.Y') }}</td>
		<td>
			<a href="{{ url('/admin/dealer/update-gallery/'.$book->id) }}">
				{{  $book->title }}
			</a>
		</td>
		<td>{{  $book->description }}</td>
		<td>{{  $book->author }}</td>
		<td>{{  $book->price }}</td>
		<td><a href="{{ url('/admin/dealer/books/edit/'.$book->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="{{ url('/admin/dealer/books/delete/'.$book->id) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
	@endforeach
	    </tbody>
</table>
</div>

@endsection