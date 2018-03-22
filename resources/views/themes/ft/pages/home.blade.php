@extends('themes.'.$theme.'.index')

@section('title')
    Fusion tables
@endsection

@section('header')
    {!! HTML::style('themes/'.$theme.'/css/jquery.toastmessage.css') !!}
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

@section('blue-line')
    Nova dimenzija trpezarije
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

@section('scripts')
    @if(Session::has('message'))
        {!! HTML::script('themes/'.$theme.'/js/jquery-2.2.4.min.js') !!}
        {!! HTML::script('themes/'.$theme.'/js/jquery.toastmessage.js') !!}
        <script>
            $().toastmessage('showSuccessToast', "Hvala na interesovanju.");
        </script>
    @endif
@endsection