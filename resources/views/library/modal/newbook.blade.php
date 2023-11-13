<form action="{{ route('library.store') }}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="modal fade text-left" id="libraryBookModal" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Book') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
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
                                        <strong>{{ __('Author') }}:</strong>
                                        <input type="text" class="form-control" placeholder="{{ __('author') }}" id="author" name="author" value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{ __('Subtitle') }}:</strong>
                                        <textarea class="form-control" placeholder="{{ __('subtitle') }}" id="subtitle" name="subtitle"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Category') }}:</strong>
                                    <select class="form-control" id="category_id" name="category_id">
                                        <option value="">{{ __('Select Category') }}</option>
                                        @foreach($allCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </fieldset>
                    @can('reading-permission')
                    <div class="col-xs-12 col-sm-12 col-md-12">
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
{{-- location, reading_text, translation, eng_loc_full?, heb_loc_full, org_book (id), org_book_page --}}