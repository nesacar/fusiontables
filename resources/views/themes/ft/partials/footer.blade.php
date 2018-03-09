<div class="full3">
    <section class="container body-content">
        <div class="row body-content-row">
            <div class="col-sm-6 col-md-4 col-lg-4 footer-logo">
                {!! HTML::Image('themes/'.$theme.'/img/logo.png', 'Fusion tables beograd', array('class' => 'logo')) !!}
                {!! $settings->footer !!}
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 contact">
                <p class="title"><a href="#">Kontakt</a></p>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i>{{ $settings->address }}</li>
                    <li><a href="mailto:{{ $settings->email1 }}"><i class="far fa-envelope"></i>{{ $settings->email1 }}</a></li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:+{{ \App\Setting::trim($settings->phone1) }}">{{ $settings->phone1 }}</a>
                        <br>
                        <a href="tel:+{{ \App\Setting::trim($settings->phone2) }}">{{ $settings->phone2 }}</a>
                    </li>

                </ul>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 insta">
                <p class="title"><a href="#">Instagram feed</a></p>
                <!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/4379931830f0549a9833d6dcac9dcbcc.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
                <p>Pratite nas: <a href="#">@fusiontablesrs</a></p>
            </div>
        </div>
    </section><!-- .container -->
</div>

<section>
    <footer>
        <div class=full2>
            <div class="container made-by">
                <div class=container>
                    <div class=row>
                        <div class="col-sm-12 col-md-8 col-lg-8 copy">
                            <p class=copyright>© Copyright 2018. All Rights Reserved, MiniStudio Publishing Group.</p>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 copy-social">
                            <div class=social-icons>
                                <a href=https://www.facebook.com/fusiontablesserbia/ target=_blank><i class="fab fa-facebook"></i></a>
                                <a href=https://www.instagram.com/fusiontables/ target=_blank><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>