<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home.index') }}" class="nav-link {{ Request::is('home.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Panel</p>
    </a>

    <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user.index') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <p>Lista użytkowników</p>
    </a>

    <a href="{{ route('department.index') }}" class="nav-link {{ Request::is('department.index') ? 'active' : '' }}">
        <i class="fas fa-building"></i>
        <p>Lista działów</p>
    </a>
</li>
