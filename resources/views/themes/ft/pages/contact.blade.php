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
        <div class="container-fluid hero-image"></div>
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


    <section>
        <div class="container about-us mb-4">
            <div class="o-nama-grid">
                <div class="o-nama-text">
                    <div class="text-left">
                        <h5>@lang('language.Kontaktirajte nas')</h5>
                        <p>@lang('language.Ukoliko')</p>
                    </div>
                    <div class="text-left">
                        {!! Form::open(['action' => ['PagesController@contactForm'], 'method' => 'POST', 'class' => 'forma']) !!}
                            <div class="row form-fields mb-2">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group required">
                                        <label for="name">@lang('language.Ime')</label>
                                        <input class="form-control" type="text" id="name" name="name" />
                                        @if ($errors->has('name'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="company">@lang('language.Kompanija')</label>
                                        <input class="form-control" type="text" id="company" name="company" />
                                        @if ($errors->has('company'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('company') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="city">@lang('language.Grad')</label>
                                        <input class="form-control" type="text" id="city" name="city" />
                                        @if ($errors->has('city'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="country">@lang('language.Država')</label>
                                        <input class="form-control" type="text" id="country" name="country" />
                                        @if ($errors->has('country'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="form-group required">
                                        <label for="profile">@lang('language.Profil')</label>
                                        <div class="select">
                                            <div class="select_field">
                                                <select id="profile" name="profile">
                                                    <option value="" disabled selected>@lang('language.Izaberite profil')</option>
                                                    <option value="kupac">@lang('language.Zainteresovan sam za kupovinu')</option>
                                                    <option value="prodavac">@lang('language.Zainteresovan sam za prodaju')</option>
                                                    <option value="arhitekta">@lang('language.Arhitekta')</option>
                                                    <option value="dizajner">@lang('language.Dizajner enterijera')</option>
                                                    <option value="agent">@lang('language.Agent/Press')</option>
                                                </select>
                                            </div>
                                        </div>
                                        @if ($errors->has('profile'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('profile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label for="email">@lang('language.E-mail adresa')</label>
                                        <input class="form-control" type="email" id="email" name="email" />
                                        @if ($errors->has('email'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="telephone">@lang('language.Telefon')</label>
                                        <input class="form-control" type="text" id="telephone" name="telephone" />
                                        @if ($errors->has('phone'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label for="message">@lang('language.Poruka')</label>
                                        <textarea class="form-control" id="message" name="message" rows="6"></textarea>
                                        @if ($errors->has('message'))
                                            <span class="error">
                                                <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative">
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="error">
                                        <strong style="font-size: 11px; font-weight: 300; color: red;">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                                <div>
                                    <button type="submit" class="btn btn-primary">@lang('language.Pošalji')</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection