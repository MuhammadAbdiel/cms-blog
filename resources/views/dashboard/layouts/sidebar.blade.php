<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/home') ? '' : 'collapsed' }}" href="/dashboard/home">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/posts*') ? '' : 'collapsed' }}" href="/dashboard/posts">
                <i class="bi bi-menu-button-wide"></i>
                <span>Posts</span>
            </a>
        </li>
        <!-- End Components Nav -->

        <!-- <li class="nav-heading">Pages</li> -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/users*') ? '' : 'collapsed' }}" href="/dashboard/users">
                <i class="bi bi-person"></i>
                <span>Authors</span>
            </a>
        </li>
        <!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories*') ? '' : 'collapsed' }}"
                href="/dashboard/categories">
                <i class="bi bi-card-list"></i>
                <span>Categories</span>
            </a>
        </li>
        <!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/templates*') ? '' : 'collapsed' }}"
                href="/dashboard/templates">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Templates</span>
            </a>
        </li>
        <!-- End Tables Nav -->

    </ul>
</aside>