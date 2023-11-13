@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="wrapper">
        <div class="mainHome sharpBook19">
            <!-- <h1>Home</h1> -->

            @canany(['library-view', 'reading-view', 'video-view'])

                @can('library-view')
                    <a role="button" class="btn" href="/library">Library</a>
                @endcan

                <br>
                <br>
                @can('reading-view')
                    <a role="button" class="btn" href="/readings">Readings</a>
                @endcan

                <br>
                <br>


                @can('video-view')
                    <a role="button" class="btn" href="/videos">Videos</a>
                @endcan
            @else
                <p>If you do not have access to any pages, please contact your admin.</p>
                @endif
            </div>

        </div>

    @endsection
