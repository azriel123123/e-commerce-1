<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.my-transaction.*') || request()->routeIs('user.transaction.index') ? '' : 'collapsed' }}" 
               data-bs-toggle="collapse" href="#transaction-nav">
                <i class="bi bi-menu-button-wide"></i>
                <span>My Transaction</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="transaction-nav"
                class="nav-content collapse {{ request()->routeIs('user.my-transaction.index') || request()->routeIs('user.my-transaction.*') ? 'show' : '' }}" 
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.my-transaction.index') }}" class="{{ request()->routeIs('user.transaction.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>My Transaction</span>
                    </a>
                </li>
            </ul>
        </li><!-- End My Transaction Nav -->

    </ul>

</aside><!-- End Sidebar -->
