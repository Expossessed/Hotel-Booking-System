@extends('layouts.hotel')

@section('body_class', 'gallery-page')

@section('content')
<section class="gallery-showcase py-5">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-5">
            <h1 class="mb-2">Gallery</h1>
            <p class="text-muted">Get a glimpse of the spaces and experiences at Hotel Bookie.</p>
        </div>

        <div class="gallery-slider swiper">
            <template class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": 1,
                    "breakpoints": {
                        "640": {
                            "slidesPerView": 2,
                            "spaceBetween": 20
                        },
                        "992": {
                            "slidesPerView": 3,
                            "spaceBetween": 24
                        }
                    }
                }
            </template>

            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="assets/img/hotel/gallery-1.webp" class="glightbox" data-gallery="hotel-gallery">
                        <img src="assets/img/hotel/gallery-1.webp" class="img-fluid rounded" alt="Lobby view">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="assets/img/hotel/gallery-2.webp" class="glightbox" data-gallery="hotel-gallery">
                        <img src="assets/img/hotel/gallery-2.webp" class="img-fluid rounded" alt="Room interior">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="assets/img/hotel/gallery-3.webp" class="glightbox" data-gallery="hotel-gallery">
                        <img src="assets/img/hotel/gallery-3.webp" class="img-fluid rounded" alt="Pool area">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="assets/img/hotel/gallery-4.webp" class="glightbox" data-gallery="hotel-gallery">
                        <img src="assets/img/hotel/gallery-4.webp" class="img-fluid rounded" alt="Restaurant">
                    </a>
                </div>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endsection
