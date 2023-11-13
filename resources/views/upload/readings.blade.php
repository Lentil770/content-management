@extends('layouts.app')

@section('content')
<body>
    <div id="dropzone" class="d-flex justify-content-center text-center">
        <form action="/upload/readings" method="POST" class="dropzone" id="file-upload" enctype="multipart/form-data" x-data="{files: false}">
            @csrf
            <div>
              <label for="uploaded_file" class="form-label">Upload Readings (.xlsx)</label>
              <input class="form-control form-control-lg"  name="uploaded_file" id="uploaded_file" @change="files = true" type="file">
            </div>

            <a class="btn btn-outline-success" download="reading_template" href="{{asset('/downloads/readingexample.xlsx')}}" title="reading_template">Download Template</a>
            
            <p class="text-danger">
                You MUST use Template File for upload.
            </p>

           <button type="submit" x-show="files" class="btn btn-lg btn-primary align-self-center">Upload</button>
        </form>
    </div>
</body>

@endsection