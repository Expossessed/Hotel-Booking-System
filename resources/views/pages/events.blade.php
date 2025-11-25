@extends('layouts.grandoria')

@section('body_class', 'events-page')

@section('content')
<section class="events-cards py-5">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-5">
            <h1 class="mb-2">Events & Gatherings</h1>
            <p class="text-muted">Host meetings, celebrations, and special moments at Hotel Bookie.</p>
        </div>

        <div class="row gy-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/event-1.webp" class="card-img-top" alt="Corporate Events">
                    <div class="card-body">
                        <h5 class="card-title">Corporate Events</h5>
                        <p class="card-text">Modern meeting rooms with AV support and tailored catering packages.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/event-4.webp" class="card-img-top" alt="Social Gatherings">
                    <div class="card-body">
                        <h5 class="card-title">Social Gatherings</h5>
                        <p class="card-text">Celebrate birthdays, engagements, and milestones in stylish spaces.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="assets/img/hotel/event-8.webp" class="card-img-top" alt="Private Dining">
                    <div class="card-body">
                        <h5 class="card-title">Private Dining</h5>
                        <p class="card-text">Intimate private rooms with bespoke menus for smaller groups.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
