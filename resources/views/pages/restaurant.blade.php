@extends('layouts.hotel')

@section('body_class', 'restaurant-page')

@section('content')
<section class="restaurant py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="mb-3">Dining at Hotel Bookie</h1>
                <p class="mb-3">Enjoy fresh, seasonal dishes and handcrafted drinks in a relaxed, contemporary setting.</p>
                <p class="mb-3">From breakfast buffets to evening cocktails, our culinary team focuses on flavor, quality, and warm hospitality.</p>
                <p class="mb-0">Let us know about any dietary preferences or special occasions—we're happy to personalize your experience.</p>
            </div>
            <div class="col-lg-6">
                <img src="assets/img/hotel/dining-2.webp" class="img-fluid rounded shadow" alt="Hotel Bookie Restaurant">
            </div>
        </div>
    </div>
</section>
@endsection
