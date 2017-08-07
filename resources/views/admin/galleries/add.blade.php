@extends('/admin/layout') @section('content_admin')
<h1>Add pictres to gallery</h1>
<p>Write the name of the gallery. If the gallery doesnt exist it will be created automaticaly.</p>
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form class="form-horizontal panel panel-default" style="width:50%;padding: 20px;" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group row">
        <label for="title" class="col-md-3">Gallery title:</label>
        <div class="col-md-9">
            <input type="text" id="title" class="form-control" name="title">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-9">
            <input type="file" name="pictures[]" multiple>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-9">
            <input type="submit" class="btn btn-primary" name="Upload pictures">
        </div>
    </div>
</form>
@foreach($listOfGalleries as $gallery)
<h2>{{ $gallery->title }}</h2> @endforeach @endsection
