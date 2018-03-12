@extends('themes.'.$theme.'.index')

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
                        <li class="breadcrumb-item active"><a href="#">iskustva</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container d-flex justify-content-center justify-content-md-end mt-1">
            @if(false) <button class="btn btn-primary ft-btn">+ Dodajte svoju izjavu</button> @endif
        </div>
        @if(count($posts))
        <div class="container">
            <ul class="testimonials-list">
                @foreach($posts as $post)
                <li class="testimonials-list__item">
                    <div class="testimonial__thumbnail">
                        {!! HTML::Image($post->image, $post->title) !!}
                    </div>
                    <div class="testimonial">
                        <h3 class="testimonial__title">{{ $post->title }}</h3>
                        <p class="testimonial__body">{{ $post->short }}</p>
                        <div class="testimonial__author">{{ $post->author }}</div>
                        <div class="testimonial__date">5 meseci 2 nedelje</div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
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
    </section>

@endsection