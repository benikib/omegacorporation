<li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Accueil</p>
        </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-bell" aria-hidden="true"></i>
        <p>
            Personnel
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('admin')}}"
                class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                <p>Administrateurs</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('utilisateur')}}"
                class="nav-link {{ Request::is('utilisateur') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book-reader" aria-hidden="true"></i>
                <p>Utilisateur</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{route('formation')}}" class="nav-link {{ Request::is('formation') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Formateurs</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('autre')}}" class="nav-link {{ Request::is('autres') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Autres</p>
    </a>
</li>