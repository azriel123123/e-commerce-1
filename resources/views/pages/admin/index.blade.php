@extends('layouts.parent')

@section('title', 'Dashboard - Admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dashboard</h5>

            <div class="section dashboard">
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">

                        

                        <div class="card-body">
                            <h5 class="card-title">Dashboard <span><span class="badge bg-success text-white"><i class="bi bi-check-circle me-1"></i> | {{ Auth::user()->role }}</span></span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <span class="text-danger small pt-1 fw-bold">{{ Auth::user()->name }}</span> <span
                                        class="text-muted small pt-2 ps-1">{{ Auth::User()->email }}</span>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="section dashboard">
            <div class="row">
                <div class="col-md-4">
                    <!-- Category Card -->
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Category</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $category }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Category Card -->
                </div>
                <div class="col-md-4">
                    <!-- Product Card -->
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Product</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart-check-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $product }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Product Card -->
                </div>
                <div class="col-md-4">
                    <!-- User Card -->
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">User</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $user }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End User Card -->
                </div>
            </div>
        </div>


        <div id="clock"></div>


        Hello {{ Auth::user()->name }}
    @endsection

    @push('scripts')
        <script>
            // Fungsi untuk menampilkan jam dengan zona waktu Indonesia (WIB)
            function showTime() {
                const date = new Date();
                const options = {
                    timeZone: 'Asia/Jakarta', // Waktu Indonesia Barat (WIB)
                    hour12: false, // Gunakan format 24 jam
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric'
                };

                // Format waktu sesuai dengan zona waktu Indonesia
                const timeString = date.toLocaleString('en-US', options);

                // Tampilkan waktu dalam elemen dengan id 'clock'
                document.getElementById('clock').innerHTML = timeString;
            }

            // Panggil fungsi showTime setiap detik
            setInterval(showTime, 1000);

            // Panggil showTime sekali saat halaman dimuat untuk menampilkan waktu awal
            showTime();
        </script>
    @endpush
