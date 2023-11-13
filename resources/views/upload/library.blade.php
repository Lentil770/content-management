@extends('layouts.app')

@section('content')
<div id="dropzone" class="d-flex justify-content-center text-center">
    <form action="/upload/library" method="POST" class="dropzone" id="file-upload" enctype="multipart/form-data" x-data="{files: false}">
        @csrf

          <div>
            <label for="uploaded_file" class="form-label">Upload Library Books (.xlsx)</label>
            <input class="form-control form-control-lg"  name="uploaded_file" id="uploaded_file" @change="files = true" type="file">
          </div>

          <a class="btn btn-outline-success" download="library_template" href="{{asset('/downloads/libraryexample.xlsx')}}" title="library_template">Download Template</a>
          
        {{-- this code is boilerplate for previewing upload --}}
        {{-- @if($headers && $headers->count() && $data && $data->count())
        <table>
            <tr>
                @foreach($headers as $h)
                    <th>{{$h}}</th>
                @endforeach
            </tr>
        
            @foreach($data as $d)
                <tr>
                    @foreach($d as $v)
                        <td>{{$v}}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
        @endif --}}
        <p class="text-danger">
            You MUST use Template File for upload.
        </p>
        
        <button type="submit" x-show="files" class="btn btn-lg btn-primary align-self-center">Upload</button>
    </form>
</div>

@endsection 