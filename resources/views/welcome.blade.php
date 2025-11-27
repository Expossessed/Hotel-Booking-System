

@section('body_class', 'index-page')


    <!-- ======= Hero Section (Hotel Bookie hero) ======= -->
    <section id="hotel-hero" class="hotel-hero d-flex align-items-center">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-3">Experience a luxurious stay at Hotel Bookie</h1>
                    <p class="mb-4">Discover elegant rooms, curated amenities, and tailored experiences designed for your perfect getaway.</p>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <a href="{{ route('bookings.form') }}" class="btn btn-primary btn-lg">Book Now</a>
                        <a href="{{ route('rooms.list') }}" class="btn btn-outline-light btn-lg">View Rooms</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center" data-aos="zoom-in" data-aos-delay="150">
                    <img src="assets/img/hotel/showcase-3.webp" alt="Hotel Bookie" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- ======= About Section ======= -->
    <section id="about" class="about-home py-5">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <img src="assets/img/hotel/showcase-8.webp" class="img-fluid rounded shadow" alt="Hotel Lobby">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-3">Welcome to Hotel Bookie</h2>
                    <p class="mb-3">Nestled in the heart of the city, Hotel Bookie offers a calm, elegant retreat with modern rooms, fine dining, and premium services for both leisure and business travelers.</p>
                    <p class="mb-3">Enjoy spacious suites, city views, wellness facilities, and personalized experiences curated by our dedicated staff.</p>
                    <a href="{{ route('rooms.list') }}" class="btn btn-outline-primary">Explore Our Rooms</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Rooms Section (dynamic from database) ======= -->
    <section id="rooms" class="rooms-showcase py-5 bg-light">
        <div class="container" data-aos="fade-up">
            <div class="text-center mb-5">
                <h2 class="mb-2">Featured Rooms</h2>
                <p class="text-muted">Carefully designed spaces for comfort, style, and relaxation.</p>
            </div>

            @if(isset($rooms) && $rooms->count())
                <div class="row gy-4">
                    @foreach ($rooms as $room)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 + ($loop->index * 100) }}">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="{{ $room->image_link }}" class="card-img-top" alt="{{ $room->room_type }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $room->room_type }}</h5>
                                    <p class="card-text mb-2">{{ $room->room_desc }}</p>
                                    <p class="fw-semibold mb-3">${{ $room->room_price }} / night</p>
                                    <div class="mt-auto d-flex justify-content-between gap-2">
                                        <a href="{{ route('rooms.view', ['id' => $room->room_id]) }}" class="btn btn-outline-secondary btn-sm">View Details</a>
                                        <a href="{{ route('bookings.form', ['room_id' => $room->room_id]) }}" class="btn btn-primary btn-sm">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-secondary text-center" role="alert">
                            No rooms available yet. Please check back soon.
                        </div>
                    </div>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('rooms.list') }}" class="btn btn-primary">View All Rooms</a>
            </div>
        </div>
    </section>

