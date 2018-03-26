@extends('themes.'.$theme.'.index')

@section('title')
    @lang('language.Kolekcije') - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/kolekcije') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/kolekcije') }}" />
@endsection

@section('blue-line')
    @lang('language.Nova dimenzija trpezarije')
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
                        <li class="breadcrumb-item"><a href="{{ url('kolekcije') }}">@lang('language.Kolekcije')</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{ $collection->title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if(count($products)>0)
    <section>
        <div class="container collections">
            <div class="row collections-grid">
                @foreach($products as $product)
                    <div class="collections-grid-item">
                        <div class="collections-image-wrapper">
                            <a href="{{ \App\Product::getProductLink($collection, $product) }}">{!! HTML::Image($product->image, $product->title, array('class' => 'img-fluid')) !!}</a>
                        </div>
                        <div class="collections-text-wrapper">
                            <h3>{{ $product->title }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection