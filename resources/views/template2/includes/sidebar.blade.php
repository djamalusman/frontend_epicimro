<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="#">Kerja Teknik</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">KT</a>
    </div>
    <ul class="sidebar-menu">
        @foreach ($menus as $menu)
            @if ($menu->is_header)
                <li class="menu-header">{{ $menu->name }}</li>
            @else
                @php
                    // Cek apakah parent atau salah satu anaknya aktif
                    $isActiveParent = $menu->url && $currentUrl === url($menu->url);
                    $isActiveChild = $menu->children->contains(fn($child) => $currentUrl === url($child->url));
                @endphp
                <li class="dropdown {{ $isActiveParent || $isActiveChild ? 'active' : '' }}">
                    <a href="{{ $menu->url ?? '#' }}" class="nav-link has-dropdown">
                        <i class="{{ $menu->icon }}"></i><span>{{ $menu->name }}</span>
                    </a>
                    @if ($menu->children->isNotEmpty())
                        <ul class="dropdown-menu">
                            @foreach ($menu->children as $child)
                                <li class="{{ $currentUrl === url($child->url) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url($child->url) }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach

    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="{{ '/welcome' }}" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Go to Apply
        </a>
    </div>
</aside>
