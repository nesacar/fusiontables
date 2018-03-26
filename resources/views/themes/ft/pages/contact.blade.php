@extends('themes.'.$theme.'.index')

@section('title')
    @lang('language.Kontakt') - Fusion tables
@endsection

@section('seo_social_stuff')
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Fusion Tables Srbija">
    <meta property="og:url" content="{{ url('/kontakt') }}">
    <meta property="og:image" content="{{ url('themes/'.$theme.'/img/fb.jpg') }}">
    <meta property="og:title" content="Vanvremenski i elegantni, Fusion stolovi kreiraju ležernu atmosferu za večeru sa prijateljima." />
    <meta property="og:description" content="{{ \App\Helper::removePTag($settings->footer) }}" />
    <link rel="canonical" href="{{ url('/kontakt') }}" />
@endsection

@section('blue-line')
    @lang('language.Kontakt')
@endsection

@section('content')

    <section>
        <div class="container-fluid hero-contact-image">
            <!-- <img src=img/collections-hero.jpg alt="hero" /> -->
        </div>
    </section>

    <section>
        <div class="container" style="padding: 0 15px;">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">home</a></li>
                        <li class="breadcrumb-item active"><a href="#">@lang('language.Kontakt')</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('language.Kontaktirajte nas')</h2>
                </div>
            </div>
        </div>
        <div class="container form-padding">
            <div class="row">
                <div class="col-md-4 vertical-center">
                    <div>
                        {!! HTML::Image('themes/'.$theme.'/img/ministudio.png', 'mini Studio Publishing Group', array('class' => 'ministudio')) !!}
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i>Zmaja od Noćaja 12, Beograd, Srbija</li>
                            <li><a href="mailto:support@fusiontables.rs"><i class="far fa-envelope"></i>support@fusiontables.rs</a></li>
                            <li><i class="fas fa-phone"></i><a href="tel:+381113282710">(+381) 11 32 82 710</a> <br> <a href="tel:+391637780088">(+381) 63 778 00 88</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    {!! Form::open(['action' => ['PagesController@contactForm'], 'method' => 'POST', 'class' => 'forma']) !!}
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Ime <span>*</span></label>
                                    <input type="text" id="name" name="name">
                                    @if ($errors->has('name'))
                                        <span class="error">
                                            <strong style="font-size: 11px; font-weight: 300;">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif

                                    <label for="email">E-mail adresa <span>*</span></label>
                                    <input type="email" id="email" name="email">
                                    @if ($errors->has('email'))
                                        <span class="error">
                                            <strong style="font-size: 11px; font-weight: 300;">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    <label for="phone">Telefon</label>
                                    <input type="text" id="phone" name="phone">

                                    <button class="btn btn-primary" type="submit">Pošalji</button>
                                </div>
                                <div class="col-md-6">
                                    <label for="message">Poruka <span>*</span></label>
                                    <textarea name="message" id="message" cols="5" rows="5"></textarea>
                                    @if ($errors->has('message'))
                                        <span class="error">
                                            <strong style="font-size: 11px; font-weight: 300;">{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

@endsection