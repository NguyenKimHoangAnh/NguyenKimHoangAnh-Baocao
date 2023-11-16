@if($submenu==true)
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{ $menu1->link }}" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
        </a>
        <ul class="dropdown-menu">
            @foreach ($listmenu2 as $menu2)
                <li>
                    <a class="dropdown-item" href="{{  $menu2->link }}">{{  $menu2->name }}</a>
                </li>
            @endforeach
        </ul>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="{{ $menu1->link }}">{{  $menu1->name }}</a>
    </li>
@endif