@extends('themes.'.$theme.'.index')

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
                            <a href="#">kolekcije</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">stolovi i sidebars</a>
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