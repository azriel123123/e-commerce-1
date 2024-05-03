<div class="modal fade" id="editModalCategory{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.category.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category {{ $row->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name"
                                value="{{ $row->name }}">
                        </div>
                        <div class="col-12">
                            <label for="categoryImage" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="categoryImage" name="image">
                        </div>
                        <div class="col-12">
                            <img src="#" alt="category image" id="preview-image"
                                class="visually-hidden img-thumbnail">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Edit Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
