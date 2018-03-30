<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('themes/'.$theme.'/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('themes/'.$theme.'/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('themes/'.$theme.'/img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('themes/'.$theme.'/img/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    @yield('seo_social_stuff')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    @yield('header')
    {!! HTML::style('themes/'.$theme.'/css/style.css') !!}

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114661451-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-114661451-1');
    </script>

    {!! NoCaptcha::renderJs() !!}
</head>

<body>
<div id="back-to-top"></div>
<nav id=side-menu>
    @if(count($topMenu))
    <div id=accordion>
        @foreach($topMenu as $menu)
            @if($menu->id == 2 || $menu->id == 3)
                <div class=card>
                    <div class=card-header id=heading-{{ $menu->id }}>
                        <h5 class=mb-0>
                            <a href="{{ url($menu->link) }}">{{ $menu->title }}</a>
                            <div class="plusic collapsed" data-toggle=collapse data-target=#collapse-{{ $menu->id }} aria-expanded=false aria-controls=collapse2> <i class="fas fa-plus"></i> </div>
                        </h5>
                    </div>
                    @php $submenu = \App\MenuLinkClear::getParentLinksById($menu->menu_id, $menu->id); @endphp
                    @if(count($submenu))
                        <div id=collapse-{{ $menu->id }} class=collapse aria-labelledby=heading-{{ $menu->id }} data-parent=#accordion>
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
                    <div class=card-header id=heading1>
                        <h5 class=mb-0> <a href="{{ url($menu->link) }}">{{ $menu->title }}</a> </h5>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @endif
</nav>

<div id="site-content">

    <div id="homepage">

        <div class=two-boxes>
            <div class=left-box>
            </div> <div class=right-box>
                <h2>@yield('blue-line')</h2>
            </div>
        </div>

        @include('themes.'.$theme.'.partials.nav')

        <div class="container-fluid fluid-nav">
            <div class="container fluid-nav-cont">
                <i class="fas fa-bars" id="trigger"></i>
                <div class="logo-wrapper">
                    <a href="{{ url('/') }}">{!! HTML::Image('themes/'.$theme.'/img/logo.png', 'Fusion tables beograd', array('class' => 'logo')) !!}</a>
                </div>

            </div>
        </div><!-- .container-fluid -->

        @yield('content')

        @include('themes.'.$theme.'.partials.footer')

    </div>
</div>

{!! HTML::script('themes/'.$theme.'/js/app.bundle.js') !!}

@yield('scripts')

<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
    / <![CDATA[ /
    var google_conversion_id = 811813840;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    / ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/811813840/?guid=ON&amp;script=0"/>
    </div>
</noscript>
</body>
</html>