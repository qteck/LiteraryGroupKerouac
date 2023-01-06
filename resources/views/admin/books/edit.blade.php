@extends('/admin/layout') 
@section('content_admin')

<h1>Edit a book</h1>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-horizontal panel panel-default" action="{{ url('/') }}/admin/dealer/books/edit-action/{{ $book->id }}" style="width:50%;padding: 20px;" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="title" class="col-md-3">Book title:</label>
        <div class="col-md-9">
            <input type="text" id="title" class="form-control" name="title" value="{{ $book->title }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-3">Brief description:</label>
        <div class="col-md-9">
            <textarea class="form-control" id="description" name="description">{{ $book->description }}</textarea>
        </div>
    </div>
    <div class="form-group">
    	<label for="picture" class="col-md-3">Book cover:</label>
        <div class="col-md-9">
            <input type="file" id="picture" name="picture">
            <img src="{{ url('/') }}/{{ $book->picture }}" alt="">
            (choose to replace existing one)
            <img src="{{ url('storage') }}/{{ $book->picture }}" alt="">
        </div>
    </div>
     <div class="form-group row">
        <label for="author" class="col-md-3">Author:</label>
        <div class="col-md-9">
            <input type="text" id="author" class="form-control" value="{{ $book->author }}" name="author">
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-md-3">Price:</label>
        <div class="col-md-9">
            <input type="text" id="price" class="form-control" value="{{ $book->price }}" name="price">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-9">
            <input type="submit" class="btn btn-primary" name="submitBook" value="Update">
        </div>
    </div>
</form>
@endsection
