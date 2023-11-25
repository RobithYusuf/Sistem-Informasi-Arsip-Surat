<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <a class="nav-link main-menu-link {{ (request()->is('admin/dashboard') || request()->is('arsiparis/dashboard') || request()->is('direktur/dashboard')|| request()->is('users/dashboard')) ? 'active' : '' }}" href="{{ route(auth()->user()->role->role . '.dashboard') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>



        @if (auth()->user()->role->role == "admin")
        <li class="nav-heading">Kelola Menu</li>
        <li class="nav-item">
            <a class="nav-link collapsed {{ (request()->is('admin/access_menu*') || request()->is('admin/menu*') || request()->is('admin/sub_menu*')) ? 'active' : '' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Kelola Menu</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ (request()->is('admin/access_menu*') || request()->is('admin/menu*') || request()->is('admin/sub_menu*')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.menu.index') }}" class="{{ request()->is('admin/menu*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sub_menu.index') }}" class="{{ request()->is('admin/sub_menu*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Sub Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.access_menu.index') }}" class="{{ request()->is('admin/access_menu*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Akses Menu</span>
                    </a>
                </li>
            </ul>
        </li>
        @endif




        @foreach($menus as $menu)
        @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);

        $isSubMenuActive = false;

        foreach ($menu->submenus as $submenu) {
        $submenuUrlSegment = explode('/', $submenu->url)[0];
        if ($segment2 == $submenuUrlSegment) {
        $isSubMenuActive = true;
        break;
        }
        }

        $menuUrlSegment = explode('/', $menu->url)[0];
        $isMenuActive = $segment2 == $menuUrlSegment || $isSubMenuActive;

        $menuUrl = url(auth()->user()->role->role . '/' . $menu->url);
        @endphp



        @if($menu->submenus->isEmpty())

        <li class="nav-item">
            <a class="nav-link {{ $isMenuActive ? 'active' : '' }}" href="{{ $menuUrl }}">
                <i class="{{ $menu->icon }}"></i>
                <span>{{ $menu->menu }}</span>
            </a>
        </li>
        @else
        <li class="nav-heading">Menu</li>
        <li class="nav-item">
            <a class="nav-link collapsed {{ $isMenuActive ? 'active' : '' }}" data-bs-target="#{{ $menu->id }}-nav" data-bs-toggle="collapse" href="#">
                <i class="{{ $menu->icon }}"></i>
                <span>{{ $menu->menu }}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="{{ $menu->id }}-nav" class="nav-content collapse {{ $isMenuActive ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                @foreach($menu->submenus as $submenu)
                @if($submenu->is_active)
                <li>
                    <a class="nav-link {{ request()->is(auth()->user()->role->role . '/' . $submenu->url . '*') ? 'active' : '' }}" href="{{ url(auth()->user()->role->role . '/' . $submenu->url) }}">

                        <i class="{{ $submenu->icon }}"></i>
                        <span>{{ $submenu->nama_submenu }}</span>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </li>
        @endif
        @endforeach


        <li class="nav-heading">Lainya</li>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="bi bi-house"></i>
                    <span>Menuju Homepage</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>


    </ul>
</aside>