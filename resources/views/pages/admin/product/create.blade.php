@extends('layouts.parent')

@section('title', 'Category - Create')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Data Product</li>
                </ol>
            </nav>

            <form action="{{ route('admin.product.store') }}" method="post">
                @csrf
                @method('POST')

                <div class="col-12">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="name" value="{{ old('name') }}">
                </div>
                <div class="col-12">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-12">
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected>Open this select menu</option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <label for="productPrice" class="form-label">Product Price</label>
                    <input type="text" class="form-control" id="productPrice" name="price" value="{{ old('price') }}">
                </div>
                <div class="col-12">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control" aria-label="With textarea" id="productDescription" name="description">{{ old('description') }}</textarea>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancle</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

            </form>
        </div>
    </div>
@endsection
