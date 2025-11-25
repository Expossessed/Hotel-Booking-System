@extends('layouts.grandoria')

@section('body_class', 'offers-page')

@section('content')
<section class="offer-cards py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-5">
            <h1 class="mb-2">Special Offers</h1>
            <p class="text-muted">Make the most of your stay at Hotel Bookie with curated packages and limited-time deals.</p>
        </div>

        <div class="row gy-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/showcase-3.webp" class="card-img-top" alt="Weekend Escape">
                    <div class="card-body">
                        <h5 class="card-title">Weekend Escape</h5>
                        <p class="card-text">Stay two nights and enjoy late checkout plus complimentary breakfast for two.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/showcase-7.webp" class="card-img-top" alt="Stay & Dine">
                    <div class="card-body">
                        <h5 class="card-title">Stay &amp; Dine</h5>
                        <p class="card-text">Enjoy a multi-course dinner in our restaurant paired with a one-night stay.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/showcase-11.webp" class="card-img-top" alt="Extended Stay">
                    <div class="card-body">
                        <h5 class="card-title">Extended Stay</h5>
                        <p class="card-text">Book five nights or more and receive a special long-stay rate.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
