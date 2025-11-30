@extends('layouts.hotel')

@section('body_class', 'amenities-page')

@section('content')
<section class="amenities-cards py-5">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-5">
            <h1 class="mb-2">Amenities & Facilities</h1>
            <p class="text-muted">Everything you need for a seamless and relaxing stay at Hotel Bookie.</p>
        </div>

        <div class="row gy-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/amenities-1.webp" class="card-img-top" alt="Infinity Pool">
                    <div class="card-body">
                        <h5 class="card-title">Rooftop Infinity Pool</h5>
                        <p class="card-text">Unwind above the city skyline with panoramic views and comfortable loungers.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/dining-2.webp" class="card-img-top" alt="Dining">
                    <div class="card-body">
                        <h5 class="card-title">Signature Dining</h5>
                        <p class="card-text">Enjoy seasonal menus, local ingredients, and crafted cocktails in our restaurant and lounge.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/amenities-5.webp" class="card-img-top" alt="Spa">
                    <div class="card-body">
                        <h5 class="card-title">Spa & Wellness</h5>
                        <p class="card-text">Recharge with massages, sauna sessions, and a fully equipped fitness studio.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
