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
                        <li class="breadcrumb-item active"><a href="#">o nama</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container about-us">
            <div class="row o-nama-grid">
                <div class="o-nama-text col-md-12">
                    <h5>o nama</h5>
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </section>

@endsection