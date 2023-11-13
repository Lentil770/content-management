<div class="modal fade text-left" id="videoModal{{$video->id}}" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Video') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('videos.update', $video->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <fieldset >
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Title') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('title') }}" id="title" name="title" value="{{$video->title}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <strong>{{ __('URL') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('url') }}" id="url" name="url" value="{{$video->video_url}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Description') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('description') }}" id="description" name="description" >{{$video->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Category') }}:</strong>

                            <select class="form-control" id="category" name="category">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        @if($video->category_id == $category->id)
                                            selected
                                        @endif
                                    >{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($video->series_id)
                        <div class="form-group">
                            <strong>{{ __('Series') }}:</strong>

                            <select class="form-control" id="series" name="series">
                                @foreach($series as $seriessingle)
                                    <option value="{{$seriessingle->id}}"
                                        @if($video->series_id == $seriessingle->id)
                                            selected
                                        @endif
                                    >{{$seriessingle->series_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if($video->course_id)
                        <div class="form-group">
                            <strong>{{ __('Course') }}:</strong>

                            <select class="form-control" id="course" name="course">
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}"
                                        @if($video->course_id == $course->id)
                                            selected
                                        @endif
                                    >{{$course->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        {{-- <div class="form-group">
                            <strong>{{ __('Reference Video') }}:</strong>

                            <select class="form-control" id="ref_video" name="ref_video">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        @if($video->category_id == $category->id)
                                            selected
                                        @endif
                                    >{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <strong>{{ __('Class Number') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('class number') }}" id="class_number" name="class_number" value="{{$video->class_number}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <strong>{{ __('Tags') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('tags') }}" id="tags" name="tags" value="{{$video->tags}}">
                            </div>
                        </div>

                    </div>
                    </fieldset>
                    @can('reading-permission')
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button onclick="return confirm('Confirm your changes')" type="submit" class="btn btn-warning">{{ __('Edit') }}</button>
                            </div>
                        </div>                        
                    @endcan
                </form>
                <form action="{{ route('videos.destroy', $video->id) }}" method="Post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete this video?')" type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>