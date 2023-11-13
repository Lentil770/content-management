<div class="d-flex flex-column align-items-stretch sharpBook19">
    <a href="{{ route('videos.index', ['category' => $currentValues['category']]) }}" class="nav-link">
        All Series and Courses
    </a>
    @if ($courses && $courses->count() > 0)
        Courses
        <ul class="">
            @foreach ($courses as $course)
                <li class="nav-item">
                    <a href="{{ route('videos.index', ['course' => $course->id, 'category' => $currentValues['category']]) }}"
                        class="nav-link" aria-current="page">
                        <div
                            class="d-flex w-100 align-items-center justify-content-between {{ $currentValues['course'] == $course->id ? 'fw-bold' : '' }}">
                            {{ $course->course_name }}
                        </div>
                    </a>
                </li>
            @endforeach
    @endif
    @if ($series && $series->count() > 0)
        Series
        @foreach ($series as $seriesSingle)
            <li class="nav-item"><a
                    href="{{ route('videos.index', ['series' => $seriesSingle->id, 'category' => $currentValues['category']]) }}"
                    class="nav-link {{ $currentValues['series'] == $seriesSingle->id ? 'fw-bold' : '' }}"
                    aria-current="page">{{ $seriesSingle->series_name }}</a></li>
        @endforeach
    @endif
    </ul>
</div>
