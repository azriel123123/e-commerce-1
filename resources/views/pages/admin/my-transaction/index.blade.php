@extends('layouts.parent')

@section('title', 'My Transaction')

@section('content')

    <h3 id="hello-text">Hello {{ Auth::user()->name }}</h3>

    <div class="card">
        <div class="card-body">
            <nav>
                <h2 class="card-title">My Transaction</h2>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Data Category</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-title"><i class="bi bi-cart"></i>List Transaction</div>

            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name Account</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Total</td>
                        <td>Action</td>
                    </tr>
                </thead>
                @forelse ($myTransactions as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ auth()->user()->name }}</td>
                    <td>{{ $transaction->name }}</td>
                    <td>{{ $transaction->email }}</td>
                    <td>{{ $transaction->phone }}</td>
                    <td>{{ $transaction->total }}</td>
                    <td>Show</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Transaction Not Found</td>
                </tr>
            @endforelse
            
            </table>
        </div>
    </div>


@endsection
