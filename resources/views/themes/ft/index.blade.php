<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fusion tables</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css">
    {!! HTML::style('themes/'.$theme.'/css/style.css') !!}
</head>

<body>
<div id="back-to-top"></div>
<nav id=side-menu>
    <div id=accordion>
        <div class=card>
            <div class=card-header id=heading1>
                <h5 class=mb-0> <a href=#>home</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading2>
                <h5 class=mb-0> <a href=#>o nama</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading3>
                <h5 class=mb-0>
                    <a href=#>kolekcije</a>
                    <div class="plusic collapsed" data-toggle=collapse data-target=#collapse2 aria-expanded=false aria-controls=collapse2> <i class="fas fa-plus"></i> </div>
                </h5>
            </div>
            <div id=collapse2 class=collapse aria-labelledby=heading2 data-parent=#accordion>
                <div class=card-body>
                    <p> <a href=#>stolovi i sidebars</a> </p> <p> <a href=#>aksesoari</a> </p>
                    <p> <a href=#>stolice i klupe</a> </p>
                    <p> <a href=#>rasveta</a> </p>
                </div>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading4>
                <h5 class=mb-0> <a href=#>dizajn</a> </h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading5>
                <h5 class=mb-0><a href=#>iskustva</a></h5>
            </div>
        </div>
        <div class=card>
            <div class=card-header id=heading6>
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
    </div>
</nav>

<div id="site-content">

    <div id="homepage">

        <div class=two-boxes>
            <div class=left-box>
            </div> <div class=right-box>
                <h2>Nova dimenzija trpezarije</h2>
            </div>
        </div>

        @include('themes.'.$theme.'.partials.nav')

        <div class="container-fluid fluid-nav">
            <div class="container fluid-nav-cont">
                <i class="fas fa-bars" id="trigger"></i>
                <div class="logo-wrapper">
                    {!! HTML::Image('themes/'.$theme.'/img/logo.png', 'Fusion tables beograd', array('class' => 'logo')) !!}
                </div>

            </div>
        </div><!-- .container-fluid -->

        @yield('content')

        @include('themes.'.$theme.'.partials.footer')

    </div>
</div>

{!! HTML::script('themes/'.$theme.'/js/app.bundle.js') !!}
</body>
</html>