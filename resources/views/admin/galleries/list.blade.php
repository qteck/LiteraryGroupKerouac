@extends('/admin/layout') 

@section('content_admin')
<h1>List of Galleries</h1>
@foreach($errors as $error)
{{ $error }}
@endforeach
<div class="table-responsive">
<table class="table table-striped">
 	<thead>
 		<tr>
 			<th>Created</th>
 			<th>Title</th>
 			<th>Status</th>
 			<th>#</th>
 			<th>#</th>
 			<th>#</th>
 		</tr>
 	</thead>
 	    <tbody>
	@foreach($listOfGalleries as $gallery)
		<tr>
		<td>{{  $gallery->created_at->format('d.m.Y') }}</td>
		<td>
			<a href="{{ url('/admin/dealer/update-gallery/'.$gallery->id) }}">
				{{  $gallery->title }}
			</a>
		</td>
		<td>{{  $gallery->status }}</td>
		<td><a href="{{ url('/galerie-prohlidka/'.$gallery->id) }}"><span class="glyphicon glyphicon-link"></span></a></td>
		<td><a href="{{ url('/admin/dealer/edit-gallery/'.$gallery->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="{{ url('/admin/dealer/delete-gallery/'.$gallery->id) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
		<tr>
			<td colspan="6">
				@foreach($gallery->photos as $photo)
					<img src="{{ asset('storage/'.$photo->title) }}" class="img-thumbnail img-responsive" style="width: 80px;height: auto;">
				@endforeach
			</td>
		</tr>
	@endforeach
	    </tbody>
</table>
</div>

@endsection