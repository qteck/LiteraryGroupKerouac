@extends('/admin/layout')

@section('content_admin')
<h1>List of articles</h1>

                    @if (session('errorNote'))
                    <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Danger!</strong>
                      {{ session('errorNote') }}
                    </div>
                    @endif  
@if($errors)
	<ul>
	@foreach ($errors as $error)
		<li>{{  $error }}</li>
	@endforeach
	</ul>
@endif

@if(count($listOfArticles) > 0)
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
	@foreach($listOfArticles as $article)
		<tr>
		<td>{{  $article->scheduled->format('d.m.Y') }}</td>
		<td>
			<a href="{{ url('/admin/dealer/update-article/'.$article->id) }}">
				{{  $article->title }}
			</a>
		</td>
		<td>{{  $article->status }}</td>
		<td><a href="{{ url('/clanek/'.$article->id) }}"><span class="glyphicon glyphicon-link"></span></a></td>
		<td><a href="{{ url('/admin/dealer/edit-article/'.$article->id) }}"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="{{ url('/admin/dealer/delete-article/'.$article->id) }}"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
	@endforeach
	    </tbody>
</table>
</div>
@else 
<p>You haven't added any article.</p>
@endif

@endsection