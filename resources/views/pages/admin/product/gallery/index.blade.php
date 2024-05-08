@extends('layouts.parent')

@section('title', 'Product Gallery')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Gallery || {{ $product->name }}</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Data Product</li>
                </ol>
            </nav>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                <i class="bi bi-plus"></i> Add Gallery
            </button>
            @include('pages.admin.product.gallery.modal-create')

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product->product_galleries as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ url('storage/product/gallery', $row->image) }}" alt="" class="img-thumbnail" width="100">
                            </td>
                            <td>
                                <form action="{{ route('admin.product.gallery.destroy', [$product->id ,$row->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Data Is Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
