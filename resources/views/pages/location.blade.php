@extends('layouts.hotel')

@section('body_class', 'location-page')

@section('content')
<section class="location-cards py-5 bg-light">
    <div class="container" data-aos="fade-up">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="mb-3">Find Hotel Bookie</h1>
                <p class="mb-3">Perfectly positioned in the heart of the city, Hotel Bookie keeps you close to business districts, cultural attractions, and nightlife.</p>
                <p class="mb-3">Public transport, cafes, shopping streets, and parks are all within walking distance, making it easy to explore like a local.</p>
                <p class="mb-0">Ask our team for personalized recommendations, transfers, and directions during your stay.</p>
            </div>
            <div class="col-lg-6">
                <img src="assets/img/hotel/location-3.webp" class="img-fluid rounded shadow" alt="Hotel Bookie Location">
            </div>
        </div>
    </div>
</section>
@endsection
