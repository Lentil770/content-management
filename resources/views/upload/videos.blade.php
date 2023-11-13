@extends('layouts.app')

@section('content')

<body>
    <div id="dropzone" class="d-flex justify-content-center text-center">
        <form action="/upload/videos" method="POST" class="dropzone" id="file-upload" enctype="multipart/form-data" x-data="{files: false}">
            @csrf
            @method('POST')

            <div>
                <label for="uploaded_file" class="form-label">Upload Videos (.xlsx)</label>
                <input class="form-control form-control-lg" name="uploaded_file" id="uploaded_file" @change="files = true" type="file">
            </div>

            <a class="btn btn-outline-success" download="video_template" href="{{asset('/downloads/videoexample.xlsx')}}" title="video_template">Download Template</a>

            <p class="text-danger">
                You MUST use Template File for upload.
                <br /><br />
                Ensure Series / Course Columns are correctly filled out, if not relevant leave column BLANK
            </p>

            <button type="submit" x-show="files" class="btn btn-lg btn-primary align-self-center">Upload</button>
        </form>
    </div>
</body>

@endsection