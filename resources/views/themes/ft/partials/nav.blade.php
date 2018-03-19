<div id=desktop-side-menu>
    <div class=logo>
        <a href="{{ url('/') }}">{!! HTML::Image('themes/'.$theme.'/img/logo.png', 'Fusion tables beograd') !!}</a>
    </div>
    @if(count($topMenu))
    <div id=accordion2>
        @foreach($topMenu as $menu)
            @if($menu->id == 3)
                <div class="card">
                    <div class=card-header id=heading-desktop-3>
                        <h5 class=mb-0>
                            <a href="{{ url($menu->link) }}">{{ $menu->title }}</a>
                            <div class="plusic collapsed" data-toggle=collapse data-target=#collapse3 aria-expanded=false aria-controls=collapse3> <i class="fas fa-sort-down"></i> </div>
                        </h5>
                    </div>
                    @php $submenu = \App\MenuLinkClear::getParentLinksById($menu->menu_id, $menu->id); @endphp
                    @if(count($submenu))
                        <div id=collapse3 class=collapse aria-labelledby=heading2 data-parent=#accordion>
                            <div class=card-body>
                                @foreach($submenu as $sub)
                                    <p> <a href="{{ url($sub->link) }}">{{ $sub->title }}</a> </p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class=card>
                    <div class=card-header id=heading-desktop-1>
                        <h5 class=mb-0> <a href="{{ url($menu->link) }}">{{ $menu->title }}</a> </h5>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @endif
    <div class=social-icons>
        <a href=https://www.facebook.com/fusiontablesserbia/ target=_blank> <i class="fab fa-facebook"></i> </a>
        <a href=https://www.instagram.com/fusiontables/ target=_blank> <i class="fab fa-instagram"></i> </a>
    </div>
    <div class=blue></div>
</div>