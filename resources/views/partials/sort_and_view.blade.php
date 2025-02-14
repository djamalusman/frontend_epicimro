<div class="display-flex2">
    <span class="text-sortby">Sort by:</span>
    <div class="dropdown dropdown-sort">
        <button class="btn dropdown-toggle" type="button" id="dropdownSort" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
            <span>{{ $sortBy ?? 'Newest Post' }}</span> <i class="fi-rr-angle-small-down"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
            <li><a class="dropdown-item {{ $sortBy == 'Newest Post' ? 'active' : '' }}" href="#" data-sort="newest">Newest Post</a></li>
            <li><a class="dropdown-item {{ $sortBy == 'Oldest Post' ? 'active' : '' }}" href="#" data-sort="oldest">Oldest Post</a></li>
{{--            <li><a class="dropdown-item {{ $sortBy == 'Rating Post' ? 'active' : '' }}" href="#" data-sort="rating">Rating Post</a></li>--}}
        </ul>
    </div>
    <div class="box-view-type">
        <a href="job-grid.html" class="view-type"><img src="assets/imgs/theme/icons/icon-list.svg" alt="jobhub" /></a>
        <a href="job-list.html" class="view-type"><img src="assets/imgs/theme/icons/icon-grid.svg" alt="jobhub" /></a>
    </div>
</div>
