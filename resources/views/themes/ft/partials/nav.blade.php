@php $route = \App\Helper::getRoute(); @endphp

<div id=desktop-side-menu>
    <div class=logo>
        <a href="{{ url('/') }}">{!! HTML::Image('themes/'.$theme.'/img/logo.png', 'Fusion tables beograd') !!}</a>
    </div>
    @if(count($topMenu))
    <div id=accordion2>
        @foreach($topMenu as $menu)
            @if($menu->id == 2 || $menu->id == 3)
                <div class="card">
                    <div class=card-header id=heading-desktop-{{ $menu->id }}>
                        <h5 class=mb-0>
                            <a href="{{ url($menu->link) }}" @if($route == $menu->link) class="active" @endif>{{ $menu->title }}</a>
                            <div class="plusic collapsed" data-toggle=collapse data-target=#collapse{{ $menu->id }} aria-expanded=false aria-controls=collapse{{ $menu->id }}> <i class="fas fa-sort-down"></i> </div>
                        </h5>
                    </div>
                    @php $submenu = \App\MenuLinkClear::getParentLinksById($menu->menu_id, $menu->id, app()->getLocale()); @endphp
                    @if(count($submenu))
                        <div id=collapse{{ $menu->id }} class=collapse aria-labelledby=heading{{ $menu->id }} data-parent=#accordion>
                            <div class=card-body>
                                @foreach($submenu as $sub)
                                    <p> <a href="{{ url($sub->link) }}" @if($route == $sub->link) class="active" @endif>{{ $sub->title }}</a> </p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class=card>
                    <div class=card-header id=heading-desktop-1>
                        <h5 class=mb-0> <a href="{{ url($menu->link) }}" @if($route == $menu->link) class="active" @endif>{{ $menu->title }}</a> </h5>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @endif

    <div class=languages>
        @if(app()->getLocale() == 'sr')
            <a class="languages__item active" href="{{ url($translate['sr']) }}">srb</a>
            <a class=languages__item href="{{ url($translate['en']) }}">eng</a>
            <a class=languages__item href="{{ url($translate['hr']) }}">hrv</a>
        @elseif(app()->getLocale() == 'en')
            <a class="languages__item" href="{{ url($translate['sr']) }}">srb</a>
            <a class="languages__item active" href="{{ url($translate['en']) }}">eng</a>
            <a class=languages__item href="{{ url($translate['hr']) }}">hrv</a>
        @else
            <a class="languages__item" href="{{ url($translate['sr']) }}">srb</a>
            <a class=languages__item href="{{ url($translate['en']) }}">eng</a>
            <a class="languages__item active" href="{{ url($translate['hr']) }}">hrv</a>
        @endif
    </div>

    <div class=social-icons>
        <a href=https://www.facebook.com/fusiontablesserbia/ target=_blank> <i class="fab fa-facebook"></i> </a>
        <a href=https://www.instagram.com/fusiontables/ target=_blank> <i class="fab fa-instagram"></i> </a>
    </div>
    <div class=blue></div>
</div>