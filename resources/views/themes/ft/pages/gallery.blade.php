@extends('themes.'.$theme.'.index')

@section('content')

    <div class="container-fluid px-0">
        <div class="image-box">
            {!! HTML::Image($images->first()->file_path) !!}
            <img src="https://ministudio.rs/download/fusion-tables/big/fusiontables-100.jpg" id="jsImageBox" />
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
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-100-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-101-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-56-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-57-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-58-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-59-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-61-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-62-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-64-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-65-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-66-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-67-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-68-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-69-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-72-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-73-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-74-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-75-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-76-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-78-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-81-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-82-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-85-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-88-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-92-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-93-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-94-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-95-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-97-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-98-S.jpg />
        <img data-is-thumbnail=true src=https://ministudio.rs/download/fusion-tables/small/fusiontables-99-S.jpg />
    </div>
    <!-- ./carousel -->

@endsection