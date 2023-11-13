<form action="{{ route('readings.store') }}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="modal fade text-left" id="readingModal" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Reading') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group" x-data="{ locationfull: '' }">
                                <strong>{{ __('Location') }}:</strong>

                                <span x-text="locationfull"></span>

                                <select class="form-control" name="location_id" id="location_id" x-on:change="(e) => locationfull = e.target.options[e.target.selectedIndex].value">
                                    @if($allLocationsFull)
                                    {{-- bc of four location levels - complex sectioned select  --}}
                                    @foreach($allLocationsFull->unique('location_a') as $location_a)
                                    <optgroup label="{{$location_a->location_a}}">
                                        @foreach($allLocationsFull->where('location_a', $location_a->location_a)->unique('location_b') as $location_b)
                                    <optgroup label="--{{$location_b->location_b}}">
                                        @foreach($allLocationsFull->where('location_a', $location_a->location_a)->where('location_b', $location_b->location_b)->unique('location_c') as $location_c)

                                        @if($location_c->location_d == null)
                                        <option value="{{$location_c->id}}">{{$location_c->location_a. ','.$location_c->location_b. ','.$location_c->location_c}}</option>
                                        @endif

                                    <optgroup label="----{{$location_c->location_c}}">
                                        @foreach($allLocationsFull->where('location_a', $location_a->location_a)->where('location_b', $location_b->location_b)->where('location_c', $location_c->location_c)->unique('location_d')->filter() as $location_d)
                                        <option value="{{$location_d->id}}">{{$location_d->location_a. ','.$location_d->location_b. ','.$location_d->location_c. ','.$location_d->location_d}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                    </optgroup>
                                    @endforeach
                                    </optgroup>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Hebrew Text') }}:</strong>
                                <input type="textarea" class="form-control" placeholder="{{ __('Name') }}" id="reading_text" name="reading_text">

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Translation') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('Name') }}" id="translation" name="translation"></textarea>

                            </div>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Hebrew Source (full)') }}:</strong>
                                <textarea class="form-control" placeholder="{{ __('Name') }}" id="hebrew_location_full" name="hebrew_location_full" value=""></textarea>
                                
                            </div>
                        </div> -->
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('English Source (full)') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="english_location_full" name="english_location_full" value="">

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Org Book') }}:</strong>
                                <select class="form-control" name="location_id" id="location_id" x-on:change="(e) => locationfull = e.target.options[e.target.selectedIndex].value">
                                    @if($allOrgBooks)
                                    @foreach($allOrgBooks as $orgBook)
                                    <option value="{{$orgBook->id}}">{{$orgBook->org_book_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{ __('Org Book Page') }}:</strong>
                                <input type="text" class="form-control" placeholder="{{ __('Name') }}" id="org_book_page" name="org_book_page" value="">

                            </div>
                        </div>
                    </fieldset>
                    @can('reading-permission')
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <button onclick="return confirm('Please Confirm')" type="submit" class="btn btn-warning">{{ __('Create') }}</button>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</form>
{{-- location, reading_text, translation, eng_loc_full?, heb_loc_full, org_book (id), org_book_page --}}