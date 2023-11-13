{{-- <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px;"> --}}
<div class="d-flex flex-column align-items-stretch">

    @if ($allCategories)
        <ul class="nav flex-column mb-auto">

            {{-- <li class="nav-item"
                style="padding-left: 4%; margin-top: 6%; padding-bottom: 3%; border-bottom: solid grey 2px; margin-bottom: 1.5em;">
                <h5>Categories</h5>
            </li> --}}

            <li class="nav-item categoriesTitle">
                {{-- <h2>Categories</h2> --}}
                <h5>Categories</h5>
            </li>

            @foreach ($allCategories as $category)
                <li class="nav-item">
                    <a href='{{ route('library.index', ['category' => $category->id]) }}' class="nav-link"
                        aria-current="page">
                        {{ $category->category_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
