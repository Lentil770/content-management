@extends('layouts.app')

@section('title', 'Home')

@section('content')



    <div class="headWrapper">
        <div class="navbar navSpace justify-content-between">

            <div class="row">
                <div class="col-8 sharpBook20">
                    <h2>Library Index Page</h2>
                </div>
                <div class="col-4 sharpBook19">
                    <form action="{{ route('library.index') }}" method="get" class="row">
                        <div class="col">
                            <input type="text" class="form-control mr-sm-2" name="search" placeholder="Search">
                        </div>
                        <div class="col-auto searchBtn">
                            <button type="submit" class="btn my-2 my-sm-0">Search</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="col-2">
                    @can('library-permission')
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#libraryBookModal">
                                New Book
                            </button>
                            @include('library.modal.newbook')

                            <a href="/upload/library" type="button" class="btn btn-outline-primary">
                                Upload Books
                            </a>
                        </div>
                    @endcan
                </div> --}}

            </div>
            <div class="row booksButton">
                <div class="d-flex justify-content-end">
                    @can('library-permission')
                        <div class="btn-group" role="group">
                            <button type="button" class="btn sharpBook19 " data-bs-toggle="modal"
                                data-bs-target="#libraryBookModal">
                                + New Book
                            </button>
                            @include('library.modal.newbook')

                            <a href="/upload/library" type="button" class="btn sharpBook19">
                                Upload Books
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>

    </div>


    <div class="headWrapper">
        <div class="row sharpBook19">
            <div class="col-3">
                @include('library.sidebar')
            </div>
            <div class="col-1"></div>

            @if ($books)
                <div class="col-8 sharpBook20">
                    {{-- <h2>Books</h2> --}}
                    {{-- <h2 style="background-color: #dee2e6; margin: 0; text-align: center; padding: 0.2em;">Books</h2> --}}
                    {{-- <h2 class="booksH2">
                        Books</h2> --}}
                    <div class="bookHeader">
                        <div class="row">
                            <div class="col-3 margLeft">Title</div>
                            <div class="col marLeft">Subtitle</div>
                        </div>
                    </div>


                    <ul class="list-group">
                        @foreach ($books as $book)
                            <a class="list-group-item" data-bs-toggle="modal"
                                data-bs-target="#libraryBookModal{{ $book->id }}">
                                <div class="col-3" style="display: inline-block">
                                    {{ $book->title }}
                                </div>
                                <div class="col"
                                    style="display: inline-block; color: grey;  text-overflow: ellipsis; overflow: hidden; white-space: nowrap; max-width: 25em; margin: 0;">
                                    {{ $book->subtitle }}
                                </div>
                            </a>
                            @include('library.modal.book')
                        @endforeach
                    </ul>
                    <div class="pagination m-auto">
                        {{ $books->links() }}
                    </div>
                </div>
                {{-- <div class="col-1"></div> --}}
            @endif
        </div>
    </div>


@endsection
