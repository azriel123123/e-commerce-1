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

            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name Account</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($myTransactions as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ auth()->user()->name }}</td>
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
                            <td><a href="{{ route('admin.my-transaction.show', $row->id) }}" class="btn btn-primary">Show</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Transaction Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
