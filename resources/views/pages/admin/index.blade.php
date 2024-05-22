@extends('layouts.parent')

@section('title', 'Dashboard - Admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dashboard</h5>

            <h3 id="hello-text">Hello {{ Auth::user()->name }}</h3>


            <p class="d-flex justify-content-end">Date = {{ $currentTime }}</p>

            <h1 id="clock" class="d-flex justify-content-end mb-4"></h1>    

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
                                    <h6>{{ $userCount }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End User Card -->
                </div>
            </div>
        </div>


    </div>

      <!-- Daftar User -->
<section class="section dashboard">
    <div class="container">
        <h5 class="card-title text-center mb-4">List of Users</h5>
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <!-- Form untuk reset password -->
                            <form action="{{ route('admin.reset-password', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary"  onclick="return confirm('Are you sure you want to Reset password for {{ $user->name }}?')">Reset Password</button>
                                <button type="submit" class="btn btn-sm btn-success"  onclick="return confirm('Are you sure you want to Change password for {{ $user->name }}?')">Change Password</button>

                            </form>
                            <!-- Form untuk change password -->
                            <form action="{{ route('admin.change-password', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <div class="input-group">
                                    <input type="password" name="new_password" placeholder="New Password" class="form-control" style="width: 150px;">
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

    <!-- Script untuk jam yang berjalan -->
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Format jam, menit, dan detik menjadi format HH:mm:ss
            var timeString = hours.toString().padStart(2, '0') + ':' +
                minutes.toString().padStart(2, '0') + ':' +
                seconds.toString().padStart(2, '0');

            // Memasukkan waktu ke dalam elemen dengan id 'clock'
            document.getElementById('clock').textContent = timeString;
        }

        // Memanggil fungsi updateClock setiap detik
        setInterval(updateClock, 1000);

        // Memanggil updateClock untuk pertama kali saat halaman dimuat
        updateClock();
    </script>

@endsection
