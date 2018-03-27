@extends('themes.'.$theme.'.index')

@section('title')
    ARCHITECT CLUB - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/o-nama') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/o-nama') }}" />
@endsection

@section('blue-line')
    ARCHITECT CLUB
@endsection

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
                        <li class="breadcrumb-item active"><a href="#">ARCHITECT CLUB</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container about-us mb-4">
            <div class="o-nama-grid">
                <div class="o-nama-text">
                    <div class="text-left">
                        <h5>ARCHITECT CLUB</h5>
                        {!! $post->body !!}
                    </div>
                    @if(\Session::has('architect'))
                        <div class="text-left">
                            <h6>Preuzmite fajlove:</h6>
                            <p>
                                @if(app()->getLocale() == 'en')
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/Bench_3D.dwg') }}">
                                      <span class="file-link__icon">
                                          {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                      </span>
                                        <span class="file-link__text">Bench_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/Chair_3D.dwg') }}">
                                  <span class="file-link__icon">
                                     {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Chair_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/dressoirs.dwg') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Dressoirs.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/Fusion_Billiard_3D.dwg') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Fusion_Billiard_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/Fusion_Table_3D.dwg') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Fusion_Table_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/measures.pdf') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                        <span class="file-link__text">Measures.pdf</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/en/requirements_layout.pdf') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                        <span class="file-link__text">Requirements_Layout.pdf</span>
                                    </a>
                                @else
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/Klupa_3D.dwg') }}">
                                      <span class="file-link__icon">
                                          {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                      </span>
                                        <span class="file-link__text">Klupa_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/Stolica_3D.dwg') }}">
                                  <span class="file-link__icon">
                                     {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Stolica_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/komoda.dwg') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Komoda.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/Fusion_Bilijar_3D.dwg') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Fusion_Bilijar_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/Fusion_Sto_3D.dwg') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Fusion_Sto_3D.dwg</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/mere.pdf') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                        <span class="file-link__text">Mere.pdf</span>
                                    </a>,
                                    <a class="file-link" href="{{ url('themes/'.$theme.'/img/arhi/sr/dimenzije_fusion_namestaja.pdf') }}">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                        <span class="file-link__text">dimenzije_fusion_namestaja.pdf</span>
                                    </a>
                                @endif
                            </p>
                        </div>
                    @else
                        <div class="text-left">
                            <h6>Preuzmite fajlove:</h6>
                            <p>
                                @if(app()->getLocale() == 'en')
                                <a class="file-link click" href="#">
                                      <span class="file-link__icon">
                                          {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                      </span>
                                    <span class="file-link__text">Bench_3D.dwg</span>
                                </a>,
                                <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                     {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                    <span class="file-link__text">Chair_3D.dwg</span>
                                </a>,
                                <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                    <span class="file-link__text">Dressoirs.dwg</span>
                                </a>,
                                <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                    <span class="file-link__text">Fusion_Billiard_3D.dwg</span>
                                </a>,
                                <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                    <span class="file-link__text">Fusion_Table_3D.dwg</span>
                                </a>,
                                <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                    <span class="file-link__text">Measures.pdf</span>
                                </a>,
                                <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                    <span class="file-link__text">Requirements_Layout.pdf</span>
                                </a>
                                @else
                                    <a class="file-link click" href="#">
                                      <span class="file-link__icon">
                                          {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                      </span>
                                        <span class="file-link__text">Klupa_3D.dwg</span>
                                    </a>,
                                    <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                     {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Stolica_3D.dwg</span>
                                    </a>,
                                    <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Komoda.dwg</span>
                                    </a>,
                                    <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Fusion_Bilijar_3D.dwg</span>
                                    </a>,
                                    <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-dwg.png') !!}
                                  </span>
                                        <span class="file-link__text">Fusion_Sto_3D.dwg</span>
                                    </a>,
                                    <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                        <span class="file-link__text">Mere.pdf</span>
                                    </a>,
                                    <a class="file-link click" href="#">
                                  <span class="file-link__icon">
                                    {!! HTML::Image('themes/'.$theme.'/img/download-pdf.png') !!}
                                  </span>
                                        <span class="file-link__text">dimenzije_fusion_namestaja.pdf</span>
                                    </a>
                                @endif
                            </p>
                            <p class="secret" style="color: red; display: none;">Da bi ste preuzeli fajlove, potrebno je prvo popuniti formu.</p>
                        </div>
                        <div class="text-left">
                            {!! Form::open(['action' => ['PagesController@architectClubUpdate'], 'method' => 'POST']) !!}
                                <div class="row mb-2">
                                    <div class="col-md-6 form-group required">
                                        <label for="name">Ime i prezime</label>
                                        <input class="form-control" type="text" id="name" name="name" />
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group required">
                                        <label for="city">Grad</label>
                                        <input class="form-control" type="text" id="city" name="city" />
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group required">
                                        <label for="country">Država</label>
                                        <input class="form-control" type="text" id="country" name="country" />
                                        @if ($errors->has('country'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group required">
                                        <label for="telephone">Telefon</label>
                                        <input class="form-control" type="text" id="telephone" name="phone" />
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group required">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="text" id="email" name="email" />
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="web">Web adresa</label>
                                        <input class="form-control" type="text" id="web" name="web" />
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="company">Kompanija</label>
                                        <input class="form-control" type="text" id="company" name="company" />
                                    </div>
                                    <div class="col-md-6 form-group required">
                                        {!! NoCaptcha::display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Pošalji</button>
                            {!! Form::close() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    {!! HTML::script('themes/'.$theme.'/js/jquery-2.2.4.min.js') !!}
    <script>
        $('.click').click(function(e){
            e.preventDefault();
            $('.secret').slideDown();
        });
    </script>
@endsection