<!-- Sidebar -->

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo">LogistiX</div>
    </div>
    <nav>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('driver') }}" class="nav-link {{ Route::is('driver') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Drivers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cargo-request') }}" class="nav-link  {{ Route::is('cargo-request') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    Cargo Requests
                </a>
            </li>
        </ul>
    </nav>
</aside>
