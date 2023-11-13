
<form action="{{ route('videos.store') }}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="modal fade text-left" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('New Video') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset >
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Title') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('title') }}" id="title" name="title" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('URL') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('url') }}" id="url" name="url" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Description') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('description') }}" id="description" name="description" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Category') }}:</strong>
                            <select class="form-control" id="category" name="category">
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>      
                        <div class="form-group">
                            <strong>{{ __('Series') }}:</strong>

                            <select class="form-control" id="series" name="series">
                                <option value="">{{ __('Select Series') }}</option>
                                @foreach($series as $seriessingle)
                                    <option value="{{$seriessingle->id}}">{{$seriessingle->series_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Course') }}:</strong>

                            <select class="form-control" id="course" name="course">
                                <option value="">{{ __('Select Course') }}</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <strong>{{ __('Class Number') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('class number') }}" id="class_number" name="class_number" >
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <strong>{{ __('Tags') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('tags') }}" id="tags" name="tags" >
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    @can('video-permission')
                        <div class="col-xs-12 col-sm-12 col-md-12" >
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button onclick="return confirm('Confirm Details')" type="submit" class="btn btn-warning">{{ __('Submit') }}</button>
                            </div>
                        </div>                        
                    @endcan
                </div>
            </div>
        </div>
    </div>
</form>