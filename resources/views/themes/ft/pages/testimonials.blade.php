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
            <button class="btn btn-primary ft-btn">+ Dodajte svoju izjavu</button>
        </div>
        <div class="container">
            <ul class="testimonials-list">
                <li class="testimonials-list__item">
                    <div class="testimonial__thumbnail">
                        {!! HTML::Image('themes/'.$theme.'/img/1.jpg', '') !!}
                    </div>
                    <div class="testimonial">
                        <h3 class="testimonial__title">lepo dizajnirani sto</h3>
                        <p class="testimonial__body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ultricies sapien vitae risus placerat dictum. Aliquam fermentum, urna a scelerisque tincidunt, ante mauris mollis ante, aliquet bibendum orci tellus id turpis. Proin sed lorem sit amet mi varius commodo. Vivamus dictum, nisi eget laoreet vulputate, lacus ex tincidunt mauris, eget faucibus urna augue et nunc. Etiam placerat ante turpis, ac elementum massa vehicula et. Duis sed ante aliquam, volutpat tortor nec, aliquet turpis. Curabitur quis velit at neque tincidunt aliquam. Cras condimentum eleifend neque et viverra.</p>
                        <div class="testimonial__author">Steven P. (UK)</div>
                        <div class="testimonial__date">5 meseci 2 nedelje</div>
                    </div>
                </li>
                <li class="testimonials-list__item">
                    <div class="testimonial__thumbnail">
                        {!! HTML::Image('themes/'.$theme.'/img/1.jpg', '') !!}
                    </div>
                    <div class="testimonial">
                        <h3 class="testimonial__title">lepo dizajnirani sto</h3>
                        <p class="testimonial__body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ultricies sapien vitae risus placerat dictum. Aliquam fermentum, urna a scelerisque tincidunt, ante mauris mollis ante, aliquet bibendum orci tellus id turpis. Proin sed lorem sit amet mi varius commodo. Vivamus dictum, nisi eget laoreet vulputate, lacus ex tincidunt mauris, eget faucibus urna augue et nunc. Etiam placerat ante turpis, ac elementum massa vehicula et. Duis sed ante aliquam, volutpat tortor nec, aliquet turpis. Curabitur quis velit at neque tincidunt aliquam. Cras condimentum eleifend neque et viverra.</p>
                        <div class="testimonial__author">Steven P. (UK)</div>
                        <div class="testimonial__date">5 meseci 2 nedelje</div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container d-flex flex-row-reverse">
            <ul class="pagination ft-pagination">
                <li class="page-item ft-page-item active"><a class="page-link ft-page-link" href="#">1</a></li>
                <li class="page-item ft-page-item"><a class="page-link ft-page-link" href="#">2</a></li>
                <li class="page-item ft-page-item"><a class="page-link ft-page-link" href="#">3</a></li>
            </ul>
        </div>
    </section>

@endsection