@extends('themes.'.$theme.'.index')

@section('content')

    <section>
        <div class="container-fluid hero-image">

        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('kolekcije/'.$collection->slug) }}">kolekcije</a></li>
                        <li class="breadcrumb-item active"><a href="">{{ $product->title }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="product-page">
        <div class="container">
            <div class="row no-gutters product">
                <div class="left-column col-xl-7 owl-carousel product-slider">
                    @if(count($photos)>0)
                        @foreach($photos as $photo)
                            <div class="slide">
                                {!! HTML::Image($photo->file_path, $product->title) !!}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="right-column col-xl-5">
                    <div class="text-holder">
                        <p>
                            <span>Spoljne dimenzije stola</span>: 2.30 m x 1.34 m ; visina : 0.75 m</p>
                        <p>
                            <span>Igrački deo</span>: 1.92 m x 0.96 m</p>
                        <p>Optimalne dimenzije prostorije *4.90 m x 3.95 m (*) sa standardnim &amp; Pro-Cup Aramith ompletom aksesoara</p>
                        <p>Minimalne dimenzije prostorije* 4.38 m x 3.42 m (*) sa premijum Aramith kompletom aksesoara</p>
                        <p>
                            <span>Boja metalnog rama</span>: RAL9003 Bela / Sjaj: 30% (saten)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container description">
            <div class="naslov-sadrzaj">
                <h3>{{ $product->title }} - Opis proizvoda </h3>
            </div>
            <div class="description-row">

                <div class="pdf">
                    <a href="#" data-toggle="tooltip" title="Skini pdf">
                        {!! HTML::Image('themes/ft/img/pdf-icon.jpg', 'skini pdf', array('class' => 'download')) !!}
                    </a>
                </div>

                <div class="sadrzaj">
                    <h5>Elegantni evropski dizajn</h5>
                    <p>
                        Elegantni diza j Fusiontable stolova koristi ridigni belo obojeni čelični ram, u koji je smeštena sva snaga i stabilnost,
                        koje su neophodne za držanje jedne igračke površine u mestu. Svi bilijarski aksesoari će biti smešteni
                        na stolu za bilijar, a niko neće znati za njih, sve dok im vi to ne otkrijete.
                    </p>

                    <h5>Dizajn džepova koji je u procesu patentiranja</h5>
                    <p>
                        Kako bi uspešno sve smestili u uzanu gornju površinu Fusiontables modela, dizajneri ovog brenda kreirali su jedinstveno rešenje
                        za džepove. Upotrebom hi-tech najlonske tkanine, ovi džepovi za koje se čeka patent se rašire kada su u
                        njima kugle, da bi se nakon igre vratili u svoje prvobitno stanje.
                    </p>

                    <h5>Spremni za igru u svako doba</h5>
                    <p>
                        Jedinstvena dizajnerska rešenja ovih stolova, ostavljaju dovoljno prostora za sve aksesoare ispod njegove gornje površine.
                        Praznina između površina – bilijarske i trpezarijske, idealna je za odlaganje bilijarskih štapova i svih
                        ostalih neophodnosti. Unikatni džepovi za kugle za koje se čeka patent su prostor u kom se kugle nalaze
                        kada ne igrate bilijar, a nikada se neće previše rastegnuti.
                    </p>

                    <h5>Easy-Lift sistem za koji se čeka patent</h5>
                    <p>
                        Opcioni Easy-Lift sistem sa oprugama dozvoljava vam da sa lakoćom izdignete svoj sto za dodatnih 75 mm na standardnu visinu
                        trpezarijskog stola od 75 cm, kako biste postigli optimalnu visinu za partiju bilijara. Ovaj sistem ne
                        zahteva održavanje i ima osobine automatskog zaključavanja i nivelisanja za koje se čeka patent, a pruža
                        vam maksimalnu.
                    </p>

                </div><!-- /.sadrzaj -->

            </div><!-- /.description-row -->

        </div><!-- /.desctiption -->

        <div class="container">
            <div class="soc">
                <div class="social">
                    Podeli
                    <a href="#">
                        {!! HTML::Image('themes/ft/img/social-icons.jpg', 'social') !!}
                    </a>
                </div>
                <div class="pdf2">
                    <a href="#" data-toggle="tooltip" title="Skini pdf">
                        {!! HTML::Image('themes/ft/img/pdf-icon.jpg', 'skini pdf', array('class' => 'download2')) !!}
                    </a>
                </div>
            </div>
        </div>

        {{--@if(count($photos)>0)--}}
        {{--<div class="container" style="position: relative">--}}
            {{--<div class="owl-carousel product-slider">--}}
                {{--@foreach($photos as $photo)--}}
                    {{--<div class="slide">--}}
                        {{--{!! HTML::Image($photo->file_path, $product->title) !!}--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}

    </section>

@endsection