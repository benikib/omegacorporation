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
            <a href="{{route('professeur')}}"
                class="nav-link {{ Request::is('professeur') ? 'active' : '' }}">
                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                <p>Professeur</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('etudiant')}}"
                class="nav-link {{ Request::is('etudiant') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book-reader" aria-hidden="true"></i>
                <p>Etudiant</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{route('cours')}}" class="nav-link {{ Request::is('cours') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Cours</p>
    </a>
</li>