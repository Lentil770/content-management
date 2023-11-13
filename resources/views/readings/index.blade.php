@extends('layouts.app')

@section('title', 'Home')

@section('content')



    <div class="headWrapper">
        <div class="navbar navSpace justify-content-between">
            <div class="row">
                <div class="col-8 sharpBook20">
                    <h2>Readings</h2>
                </div>

                {{-- <div class="col-3"> @can('reading-permission')
                        <div class="btn-group readButtons" role="group">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#readingModal">
                                New Reading
                            </button>
                            @include('readings.modal.newreading')

                            <a href="/upload/readings" type="button" class="btn">
                                Upload Readings
                            </a>
                        </div>
                    @endcan
                </div> --}}
                <div class="col-4 sharpBook19">
                    <form action="/readings" method="get" class="row">
                        {{-- <div>

                        </div>
                        <input class="form-control searchColor" type="search" placeholder="search" id="search"
                            aria-label="Search">
                        <button type="submit" class="btn btn-outline-success my-2 my-sm-0">🔍</button> --}}

                        {{-- <img src="public/images/search.svg" alt="" class="searchIcon"> --}}




                        <div class="col">
                            <input type="text" class="form-control mr-sm-2" name="search" placeholder="Search"
                                style="background-color:white; ">
                        </div>
                        <div class="col-auto searchBtn">
                            <button type="submit" class="btn my-2 my-sm-0">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row booksButton">
                <div class="d-flex justify-content-end">
                    @can('reading-permission')
                        <div class="btn-group readButtons" role="group">
                            <button type="button" class="btn sharpBook19" data-bs-toggle="modal"
                                data-bs-target="#readingModal">
                                + New Reading
                            </button>
                            @include('readings.modal.newreading')

                            <a href="/upload/readings" type="button" class="btn sharpBook19">
                                Upload Readings
                            </a>
                        </div>
                    @endcan

                </div>


            </div>
        </div>
    </div>




    <div class="headWrapper">
        <div class="breadStyle sharpBook20">
            @if ($currentLocation['A'])
                <div class="breadcrumb col" style="display: inline;">
                    @if ($currentLocation['A'])
                        <a href="/readings/{{ $currentLocation['A'] }}">{{ $currentLocation['A'] }}</a>
                    @endif
                    @if ($currentLocation['B'])
                        >
                        <a
                            href="/readings/{{ $currentLocation['A'] }}/{{ $currentLocation['B'] }}">{{ $currentLocation['B'] }}</a>
                    @endif
                    @if ($currentLocation['C'])
                        >
                        <a
                            href="/readings/{{ $currentLocation['A'] }}/{{ $currentLocation['B'] }}/{{ $currentLocation['C'] }}">{{ $currentLocation['C'] }}</a>
                    @endif
                    @if ($currentLocation['D'])
                        >
                        <a href="/readings/{{ $currentLocation['A'] }}/{{ $currentLocation['B'] }}/{{ $currentLocation['C'] }}/{{ $currentLocation['D'] }}"
                            class="font-bold">{{ $currentLocation['D'] }}</a>
                    @endif
                </div>
            @endif

        </div>


        <div class="row sharpBook19">
            <div class="col-3">
                @include('readings.sidebar')
            </div>

            <div class="col-4">
                {{-- <div class="col-6"> --}}

                @if ($locations)
                    <h2 class="readH2">
                        Locations</h2>
                    {{-- <h2 style="margin: 0; padding: 0.2em; margin-left:29px; border-bottom: 1px solid black;">
                        Locations</h2> --}}
                    <ul class="row cardRow">
                        @foreach ($locations as $location)
                            <div class="card">
                                <a href='{{ $location->location_url }}' class="card-body"
                                    style="text-decoration: none">{{ $location->location_name }}</a>
                            </div>
                        @endforeach
                    </ul>
                @endif

            </div>

            <div class="col-5">
                @if ($readings)
                    {{-- <div class="col"> --}}
                    <h2 class="booksH2">Readings</h2>
                    <ul class="list-group">
                        @foreach ($readings as $reading)
                            <a class="list-group-item" data-bs-toggle="modal"
                                data-bs-target="#readingModal{{ $reading->reading_id }}">
                                <div class="row">
                                    <div class="col-6"
                                        style="display: inline-block; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; margin: 0;">
                                        {{ $reading->reading_text }}
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-5" style="display: inline-block; color: grey;  ">
                                        {{ $reading->english_location_full }}
                                    </div>
                                </div>
                            </a>
                            @include('readings.modal.reading')
                        @endforeach
                    </ul>
                    <div class="pagination m-auto">
                        {{ $readings->links() }}
                    </div>
                    {{-- </div> --}}
                    {{-- <div class="col-1"></div> --}}
                @endif

            </div>
            {{-- 
            <div class="col-3">
                @if ($readings)
                    <div class="col">
                        <h2 style="background-color: #dee2e6; margin: 0; text-align: center; padding: 0.2em;">Readings</h2>
                        <ul class="list-group">
                            @foreach ($readings as $reading)
                                <a class="list-group-item" data-bs-toggle="modal"
                                    data-bs-target="#readingModal{{ $reading->reading_id }}">
                                    <div class="col-6"
                                        style="display: inline-block; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; max-width: 25em; margin: 0;">
                                        {{ $reading->reading_text }}
                                    </div>
                                    <div class="col-3" style="display: inline-block; color: grey;  ">
                                        {{ $reading->english_location_full }}
                                    </div>
                                </a>
                                @include('readings.modal.reading')
                            @endforeach
                        </ul>
                        <div class="pagination m-auto">
                            {{ $readings->links() }}
                        </div>
                    </div>
                    <div class="col-1"></div>
                @endif
            </div> --}}


        </div>


        <div class="row sharpBook19">

        </div>

    </div>



@endsection
