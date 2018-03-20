@extends('themes.'.$theme.'.index')

@section('title')
    Galerija - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/galerija') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/galerija') }}" />
@endsection

@section('content')

    <div class="container-fluid px-0">
        <div class="image-box">
            {!! HTML::Image($images->first()->file_path, 'fusion tables beograd', array('id' => 'jsImageBox')) !!}
        </div>
    </div>

    <section>
        <div class="container" style="padding: 0 15px;">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                        <li class="breadcrumb-item active"><a href="#">galerija</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- carousel -->
    <div class="image-gallery container owl-carousel" id="jsImageGallery">
        @foreach($images as $image)
            {!! HTML::Image($image->file_path_small, 'fusion tables beograd', array('data-is-thumbnail' => true)) !!}
        @endforeach
    </div>
    <!-- ./carousel -->

@endsection