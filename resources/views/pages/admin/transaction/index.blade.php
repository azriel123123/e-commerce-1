@extends('layouts.parent')

@section('title', 'Transaction')

@section('content')

    <style>
        /* Page load animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        body {
            animation: fadeIn 1s ease-in-out;
        }

        /* Card hover animation */
        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 1s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Breadcrumb item animation */
        .breadcrumb-item + .breadcrumb-item::before {
            content: '>';
        }

        /* Button animations */
        .btn-info, .btn-primary {
            transition: background-color 0.3s ease, transform 0.3s ease;
            animation: fadeIn 1.2s ease-in-out;
        }

        .btn-info:hover {
            background-color: #138496;
            transform: translateY(-2px);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        /* Table row hover animation */
        .table tbody tr {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            transform: scale(1.02);
        }

        /* Badge animation */
        .badge {
            font-size: 0.9em;
            animation: fadeIn 1.5s ease-in-out;
        }
    </style>

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
            <div class="card-title"><i class="bi bi-cart"></i> List Transaction</div>

            <table class="table table-bordered table-hover mt-4">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Receiver Name</th>
                        <th>Transaction Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Payment</th>
                        <th>Payment URL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>
                                @if ($row->status === 'expired')
                                    <span class="badge bg-danger">Expired</span>
                                @elseif ($row->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($row->status === 'settlement')
                                    <span class="badge bg-success">Settlement</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($row->total_price)}}</td>
                            <td>{{ $row->payment }}</td>
                            <td>
                                @if ($row->payment_url)
                                    <a href="{{ $row->payment_url }}" target="_blank" class="btn btn-info d-flex justify-content-center">Pay</a>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Transaction Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
