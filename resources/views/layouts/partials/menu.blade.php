<ul class="menu">
    <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if(auth()->user()->isMissionary())
        <li class="sidebar-item {{ request()->routeIs('missionary.*') ? 'active' : '' }}">
            <a href="{{ route('missionary.dashboard') }}" class="sidebar-link">
                <i class="bi bi-house-door-fill"></i>
                <span>Meu Campo</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('connections.teams.search') ? 'active' : '' }}">
            <a href="{{ route('connections.teams.search') }}" class="sidebar-link">
                <i class="bi bi-link-45deg"></i>
                <span>Conexões</span>
            </a>
        </li>
    @elseif(auth()->user()->isVolunteer())
        <li class="sidebar-item {{ request()->routeIs('volunteer.dashboard') ? 'active' : '' }}">
            <a href="{{ route('volunteer.dashboard') }}" class="sidebar-link">
                <i class="bi bi-people-fill"></i>
                <span>Minha Equipe</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('connections.fields.search') ? 'active' : '' }}">
            <a href="{{ route('connections.fields.search') }}" class="sidebar-link">
                <i class="bi bi-search"></i>
                <span>Buscar Campos</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('connections.index') ? 'active' : '' }}">
            <a href="{{ route('connections.index') }}" class="sidebar-link">
                <i class="bi bi-link-45deg"></i>
                <span>Conexões</span>
            </a>
        </li>
    @endif

    <li class="sidebar-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="sidebar-link">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span>
            </a>
        </form>
    </li>
</ul>