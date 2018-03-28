@extends('themes.'.$theme.'.index')

@section('title')
    @lang('language.Katalog') - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/o-nama') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/o-nama') }}" />
@endsection

@section('blue-line')
    @lang('language.Katalog')
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
                        <li class="breadcrumb-item active"><a href="#">@lang('language.Katalog')</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container about-us mb-4">
            <div class="o-nama-grid">
                <div class="o-nama-text">
                    <div class="text-left">
                        <h5>@lang('language.Katalog')</h5>
                        {!! $post->body !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a class="katalog" href="{{ url('themes/'.$theme.'/img/katalog/Brosura_Fusion_Sto.pdf') }}">
                                <div class="katalog-img">
                                    {!! HTML::Image('themes/'.$theme.'/img/Brosura-FT-Srb.jpg', 'katalog') !!}
                                    <div class="katalog-img__icon">
                                        {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png', 'pdf ikonica', array('class' => 'icon')) !!}
                                    </div>
                                </div>
                                <p>Katalog na srpskom</p>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="katalog" href="{{ url('themes/'.$theme.'/img/katalog/Brochure_Fusion_Table.pdf') }}">
                                <div class="katalog-img">
                                    {!! HTML::Image('themes/'.$theme.'/img/Brochure-FT-Eng.jpg', 'katalog') !!}
                                    <div class="katalog-img__icon">
                                        {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png', 'pdf ikonica', array('class' => 'icon')) !!}
                                    </div>
                                </div>
                                <p>Katalog na engleskom</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    {!! HTML::script('themes/'.$theme.'/js/jquery-2.2.4.min.js') !!}
    <script>
        $('.click').click(function(e){
            e.preventDefault();
            $('.secret').slideDown();
        });
    </script>
@endsection