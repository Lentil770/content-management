<div class="modal fade text-left" id="libraryBookModal{{$book->id}}" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Book') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('library.update', $book->id) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                    <fieldset >
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Title') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('title') }}" id="title" name="title" value="{{$book->title}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12"> 
                            <div class="form-group">
                                <strong>{{ __('Author') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('author') }}" id="author" name="author" value="{{$book->author}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Subtitle') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('subtitle') }}" id="subtitle" name="subtitle" >{{$book->subtitle}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Category') }}:</strong>

                            <select class="form-control" id="category" name="category">
                                @foreach($allCategories as $category)
                                    <option value="{{$category->id}}"
                                        @if($book->category_id == $category->id)
                                            selected
                                        @endif
                                    >{{$category->category_name}}</option>
                                @endforeach
                            </select>
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
                <form action="{{ route('library.destroy', [$book->id]) }}" method="Post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete this book?')" type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>