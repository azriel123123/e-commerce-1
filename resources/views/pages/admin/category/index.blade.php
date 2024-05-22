@extends('layouts.parent')

@section('title', 'Category')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Category</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                    <li class="breadcrumb-item active">Data Category</li>
                </ol>
            </nav>

            {{-- Button Modal Create Category --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModalCategory">
                <i class="bi bi-plus"></i>
                Add Category
            </button>
            @include('pages.admin.category.modal-create')

            <table class="table table-striped table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $row)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $row->name }}</td>
                            <td>
                                <img src="{{ url('storage/category/', $row->image) }}" alt="{{ $row->name }}" class="img-thumbnail" style="max-width: 100px;">
                            </td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalCategory{{ $row->id }}" type="button">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.category.destroy', $row->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data Is Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        ;

        (function($) {
            function readURL(input) {
                var $prev = $('preview-image')

                if (input.files && input.files[0]) {
                    var reader = new FileReader()

                    reader.onload = function(e) {
                        $prev.attr('src', e.target.result)
                    }

                    reader.readAsDataURL(input.files[0])
                    $prev.attr('class', '')
                } else {
                    $prev.attr('class', 'visually-hidden')
                }
            }

            $('#image').on('change', function() {readURL(this)})
        })(jQuery)
    </script>
@endpush
