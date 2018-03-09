@extends('themes.'.$theme.'.index')

@section('content')
    @if(count($images))
        <div class="container-fluid slajder">
            <div class="index-slider">
                <div class="arrow-right"></div>
                <div class="owl-carousel home-slider owl-theme">
                    @foreach($images as $image)
                        <div class="slide col-md-12">
                            {!! HTML::Image($image->file_path, 'Fusion table Beograd') !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!-- .container-fluid -->
    @endif
@endsection