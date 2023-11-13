<div class="modal fade text-left" id="readingModal{{$reading->reading_id}}" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Edit Reading') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('readings.update', $reading->reading_id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <fieldset>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Location') }}:</strong>
                                <select class="form-control" name="location_id" id="location_id">

                                    <option value="{{$reading->location_id}}">{{$reading->location_a . ',' . $reading->location_b . ',' . $reading->location_c . ',' . $reading->location_d}}</option>

                                    @can('reading-permission')
                                    @if($allLocationsFull)
                                    {{-- bc of four location levels - complex sectioned select  --}}
                                    @foreach($allLocationsFull->unique('location_a') as $location_a)
                                    <optgroup label="{{$location_a->location_a}}">
                                        @foreach($allLocationsFull->where('location_a', $location_a->location_a)->unique('location_b') as $location_b)
                                    <optgroup label="&#8594;{{$location_b->location_b}}">
                                        @foreach($allLocationsFull->where('location_a', $location_a->location_a)->where('location_b', $location_b->location_b)->unique('location_c') as $location_c)

                                        @if($location_c->location_d == null)
                                        <option value="test{{$location_c->id}}">{{$location_c->location_a. ','.$location_c->location_b. ','.$location_c->location_c}}</option>
                                        @endif

                                    <optgroup label="&#8594;&#8594;{{$location_c->location_c}}">
                                        @foreach($allLocationsFull->where('location_a', $location_a->location_a)->where('location_b', $location_b->location_b)->where('location_c', $location_c->location_c)->unique('location_d')->filter() as $location_d)
                                        <option value="-- --{{$location_d->id}}">{{$location_d->location_a. ','.$location_d->location_b. ','.$location_d->location_c. ','.$location_d->location_d}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                    </optgroup>
                                    @endforeach
                                    </optgroup>
                                    @endforeach
                                    @endif
                                    @endcan
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Hebrew Text') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('Name') }}" id="reading_text" name="reading_text">{{$reading->reading_text}}</textarea>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Translation') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('Name') }}" id="translation" name="translation">{{$reading->translation}}</textarea>

                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Hebrew Source (full)') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="hebrew_location_full" name="hebrew_location_full" value="{{$reading->hebrew_location_full}}">
                                
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('English Source (full)') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="english_location_full" name="english_location_full" value="{{$reading->english_location_full}}">

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Org Book(s)') }}:</strong>
                                @if ($allOrgBooks)
                                @foreach($allOrgBooks as $orgBook)
                                <span class='org-book-tag' value="{{$orgBook->id}}">{{$orgBook->org_book_name}}<span data-role="remove"></span></span>
                                @endforeach
                                @endif

                                <!-- <option value="{{$reading->org_book_id}}">{{$reading->org_book_name}}</option> -->

                                @can('reading-permission')
                                @if ($allOrgBooks)
                                <br><strong>{{ __('Add New Book') }}:</strong>
                                <select class="form-control" name="org_book_id" id="org_book_id">
                                    <option selected></option>
                                    @foreach($allOrgBooks as $orgBook)
                                    <option value="{{$orgBook->id}}">{{$orgBook->org_book_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @endcan
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('org Book Page') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="org_book_page" name="org_book_page" value="{{$reading->org_book_page}}">

                            </div>
                        </div>
                    </fieldset>
                    @can('reading-permission')
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button onclick="return confirm('Confirm your changes')" type="submit" class="btn btn-warning">{{ __('Edit') }}</button>
                        </div>
                    </div>
                    @endcan
                </form>
                @can('reading-permission')
                <form action="{{ route('readings.destroy',$reading->reading_id) }}" method="Post">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure you want to delete this reading?')" type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>

<style>
    .org-book-tag {
        border: solid 1px pink;
        background-color: pink;
        border-radius: 9%;
        margin: 2px;
        padding: 3px;
    }
</style>