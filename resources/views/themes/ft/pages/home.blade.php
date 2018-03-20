@extends('themes.'.$theme.'.index')

@section('title')
    Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/') }}" />
@endsection

@section('content')
    @if(count($images))
        <div class="container-fluid slajder">
            <div class="index-slider">
                <div class="arrow-right"></div>
                <div class="owl-carousel home-slider owl-theme">
                    @foreach($images as $image)
                        <div class="slide col-md-12">
                            {!! HTML::Image($image->file_path, 'Fusion table Beograd') !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!-- .container-fluid -->
    @endif
@endsection