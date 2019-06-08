@extends('layouts.base')


@section('content')

    <form action="{{url('/visa_file_upload')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group">
            <label for="upload-file">Upload</label>
            <input type="file" name="upload-visa-file" class="form-control">
        </div>
        <input class="btn btn-success" type="submit" value="Upload Image" name="submit">
    </form>

@endsection
