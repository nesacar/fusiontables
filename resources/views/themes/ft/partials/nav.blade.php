<div id=desktop-side-menu>
    <div class=logo>
        {!! HTML::Image('themes/'.$theme.'/img/logo.png', 'Fusion tables beograd') !!}
    </div>
    @if(count($topMenu))
    <div id=accordion2>
        @foreach($topMenu as $menu)
            @if($menu->slug == 'kolekcije')
                <div class=card-header id=heading-desktop-3>
                    <h5 class=mb-0>
                        <a href="{{ url($menu->link) }}">{{ $menu->title }}</a>
                        <div class="plusic collapsed" data-toggle=collapse data-target=#collapse3 aria-expanded=false aria-controls=collapse3> <i class="fas fa-sort-down"></i> </div>
                    </h5>
                </div>
                @php $submenu = \App\Menu::find(1)->menuLinks()->where('publish', 1)->where('parent', $menu->id)->orderBy('order', 'ASC')->get(); @endphp
                @if(count($submenu))
                    <div id=collapse3 class=collapse aria-labelledby=heading2 data-parent=#accordion>
                        <div class=card-body>
                            @foreach($submenu as $sub)
                                <p> <a href="{{ url($sub->link) }}">{{ $sub->title }}</a> </p>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div class=card>
                    <div class=card-header id=heading-desktop-1>
                        <h5 class=mb-0> <a href="{{ url($menu->link) }}">{{ $menu->title }}</a> </h5>
                    </div>
                </div>
            @endif
        @endforeach
        @if(false)
        <div class=card>
            <div class=card-header id=heading-desktop-1>
                <h5 class=mb-0> <a href=#>home</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-2>
                <h5 class=mb-0> <a href=#>o nama</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-3>
                <h5 class=mb-0>
                    <a href=#>kolekcije</a>
                    <div class="plusic collapsed" data-toggle=collapse data-target=#collapse3 aria-expanded=false aria-controls=collapse3> <i class="fas fa-sort-down"></i> </div>
                </h5>
            </div>
            <div id=collapse3 class=collapse aria-labelledby=heading2 data-parent=#accordion>
                <div class=card-body>
                    <p> <a href=#>stolovi i sidebars</a> </p>
                    <p> <a href=#>aksesoari</a> </p>
                    <p> <a href=#>stolice i klupe</a> </p>
                    <p> <a href=#>rasveta</a> </p>
                </div>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-4>
                <h5 class=mb-0> <a href=#>dizajn</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-5>
                <h5 class=mb-0> <a href=#>iskustva</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-6>
                <h5 class=mb-0> <a href=#>kvalitet</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-7>
                <h5 class=mb-0> <a href=#>galerija</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-7>
                <h5 class=mb-0> <a href=#>press</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading-desktop-7>
                <h5 class=mb-0> <a href=#>kontakt</a> </h5>
            </div>
        </div>
        @endif
    </div>
    @endif
    <div class=social-icons>
        <a href=https://www.facebook.com/fusiontablesserbia/ target=_blank> <i class="fab fa-facebook"></i> </a>
        <a href=https://www.instagram.com/fusiontables/ target=_blank> <i class="fab fa-instagram"></i> </a>
    </div>
    <div class=blue></div>
</div>