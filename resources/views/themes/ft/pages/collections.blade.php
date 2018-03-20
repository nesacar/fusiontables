@extends('themes.'.$theme.'.index')

@section('title')
    Kolekcije - Fusion tables
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
                        <li class="breadcrumb-item"><a href="{{ url('kolekcije') }}">kolekcije</a></li>
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