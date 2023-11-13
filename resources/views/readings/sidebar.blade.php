<div class="d-flex flex-column align-items-stretch">
    @if ($allLocations)
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item categoriesTitle">
                <h5>Locations</h5>
            </li>
            @foreach ($allLocations as $location)
                <li class="nav-item">
                    <a href='{{ $location->location_url }}'
                        class="nav-link {{ $currentLocation['A'] == $location->location_a ? 'text-muted' : '' }} "
                        aria-current="page">
                        {{ $location->location_a }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
