@extends('themes.'.$theme.'.index')

@section('title')
    @lang('language.Press') - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/press') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/press') }}" />
@endsection

@section('blue-line')
    @lang('language.Press')
@endsection

@section('content')

    <section>
        <div class="container-fluid hero-image"></div>
    </section>

    <section>
        <div class="container" style="padding: 0 15px;">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">@lang('language.Kolekcije')</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">@lang('language.Press')</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if(count($posts))
        <!-- content -->
        <section class="container" id="press">
            <div class="row">
                @foreach($posts as $post)
                <div class="col-md-6 press-item">
                    <div class="press-item__thumbnail">
                        {!! HTML::Image($post->image, $post->title) !!}
                    </div>
                    <div class="press-item__details">
                        <h3 class="press-item__title">{{ $post->title }}</h3>
                        <div class="press-item__date">{!! $post->body !!}</div>
                        @if(!empty($post->pdf))
                            <a href="{{ url($post->pdf) }}" class="press-item__link" target="_blank">
                                <img src="{{ url('themes/'.$theme.'/img/pdf-icon.jpg') }}" alt="download" />
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <!-- ./content -->

        <div class="container d-flex flex-row-reverse">
            @if(false)
            <ul class="pagination ft-pagination">
                <li class="page-item ft-page-item active"><a class="page-link ft-page-link" href="#">1</a></li>
                <li class="page-item ft-page-item"><a class="page-link ft-page-link" href="#">2</a></li>
                <li class="page-item ft-page-item"><a class="page-link ft-page-link" href="#">3</a></li>
            </ul>
            @else
                {{ $posts->appends(\Illuminate\Support\Facades\Input::all())->links( "pagination::bootstrap-4") }}
            @endif
        </div>
    @endif

@endsection