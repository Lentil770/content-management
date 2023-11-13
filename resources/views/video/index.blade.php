@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <div class="headWrapper">
        <div class="navbar navSpace justify-space-between">

            <div class="row">
                <div class="col-6 sharpBook20">
                    <h2>Video Index</h2>
                </div>
                <div class="col-2 sharpBook19">
                    <select class="form-select" id="category" name="category" onchange="window.location.href=this.value">
                        <option value="#">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ route('videos.index', ['category' => $category->id]) }}"
                                {{ $currentValues['category'] == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 sharpBook19">
                    <form action="{{ route('videos.index') }}" method="get" class="row">
                        {{-- to submit values in route for inner search --}}
                        <input name="category" type="hidden" value="{{ $currentValues['category'] }}" />

                        <div class="col">
                            <input type="text" class="form-control mr-sm-2" name="search" placeholder="Search">
                        </div>

                        <div class="col-auto searchBtn">
                            <button type="submit" class="btn my-2 my-sm-0">Search</button>
                        </div>
                        <div class="form-check formSpace">
                            <input class="form-check-input" type="checkbox" value="include_filters" name="include_filters"
                                id="include_filters" {{ $currentValues['include_filters'] === true ? 'checked' : '' }}>
                            <label class="form-check-label" for="include_filters">Search within Category?</label>
                        </div>
                    </form>
                </div>

                {{-- <div class="col-2">
                    @can('video-permission')
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#videoModal">
                                New Video
                            </button>
                            @include('video.modal.newvideo')
                            <a href="/upload/videos" type="button" class="btn btn-outline-primary">
                                Upload Videos
                            </a>
                        </div>
                    @endcan
                </div> --}}
            </div>

            <div class="row booksButton">
                <div class="d-flex justify-content-end sharpBook19">
                    @can('video-permission')
                        <div class="btn-group" role="group">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#videoModal">
                                + New Video
                            </button>
                            @include('video.modal.newvideo')
                            <a href="/upload/videos" type="button" class="btn">
                                Upload Videos
                            </a>
                        </div>
                    @endcan
                </div>

            </div>

        </div>

    </div>
















    <div class="headWrapper">
        <div class="row">
            <div class="col-3">
                @include('video.sidebar')
            </div>
            <div class="col-1"></div>
            {{-- <div class="col-8"> --}}
            @if ($videos)
                <div class="col-8 sharpBook20">
                    <h2 class="booksH2">Videos</h2>
                    <ul class="list-group">
                        @foreach ($videos as $video)
                            <a class="list-group-item" data-bs-toggle="modal"
                                data-bs-target="#videoModal{{ $video->id }}">
                                <div class="col-3" style="display: inline-block">
                                    {{ $video->title }}
                                </div>
                                <div class="col"
                                    style="display: inline-block;
                                color: grey; 
                                text-overflow: ellipsis; 
                                overflow: hidden; 
                                white-space: nowrap;
                                max-width: 25em;
                                margin: 0;">
                                    {{ $video->description }}
                                </div>
                            </a>
                            @include('video.modal.video')
                        @endforeach
                    </ul>
                    <div class="pagination m-auto">
                        {{ $videos->links() }}
                    </div>
                </div>
                {{-- <div class="col-1"></div> --}}

            @endif
            {{-- </div> --}}


        </div>



    </div>




@endsection
