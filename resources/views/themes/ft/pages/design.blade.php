@extends('themes.'.$theme.'.index')

@section('title')
    @lang('language.Dizajn') - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/dizajn') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/dizajn') }}" />
@endsection

@section('blue-line')
    @lang('language.Dizajn')
@endsection

@section('content')

    <section>
        <div class="container-fluid hero-image">
            <!-- <img src=img/collections-hero.jpg alt="hero" /> -->
        </div>
    </section>

    <section>
        <div class="container" style="padding: 0 15px;">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                        <li class="breadcrumb-item active"><a href="#">@lang('language.Priča o dizajnu')</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container about-us">
            <div class="row o-nama-grid">
                <div class="o-nama-text col-md-12">
                    <h5>@lang('language.Priča o dizajnu')</h5>
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </section>

@endsection