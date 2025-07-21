@extends('layout.app')

@section('content')

<!-- Top Search Section -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="d-flex align-items-center border rounded px-3 py-1 bg-white shadow-sm">
                <i class="bx bx-search fs-4 lh-0 me-2"></i>
                <input
                    type="text"
                    class="form-control border-0 shadow-none p-0"
                    placeholder="Search..."
                    id="searchProduct"
                    aria-label="Search..."
                />
            </div>
        </div>
    </div>
</div>
<!-- /Top Search Section -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Products /</span> Product List
    </h4>

    <!-- Add Product Button -->
    <div class="mb-3">
        <button class="btn btn-primary" id="showAddProductForm">
            <i class="bx bx-plus me-1"></i> Add New Product
        </button>
    </div>


    <!-- Hidden Add Product Form -->
    <div id="addProductForm" class="card p-3 mb-4" style="display: none;">
        <h5>Add New Product</h5>
        <form id="newProductForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price (Rs.)</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-secondary" id="cancelAddProduct">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Product List -->
    <div class="card">
        <div class="card-body">
            <div id="productList" class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach ($products as $pro)
                    <div class="col">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('storage/products/'.$pro->image) }}" alt="{{ $pro->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $pro->name }}</h5>
                                <p class="card-text text-primary fw-semibold">Rs. {{ $pro->price }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $pro->id }}" data-name="{{ $pro->name }}" data-price="{{ $pro->price }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </button>
                                    <a href="javascript:void(0);" data-id="{{ $pro->id }}" class="btn btn-sm btn-danger delete-btn">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Custom Edit Modal -->
<div id="editOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; backdrop-filter:blur(5px); background-color:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div class="card p-4" style="max-width:400px; width:90%;">
        <h5>Edit Product</h5>
        <form id="editProductForm">
            @csrf
            <input type="hidden" id="edit_id" name="id">
            <div class="mb-3">
                <label for="edit_name" class="form-label">Product Name</label>
                <input type="text" id="edit_name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="edit_price" class="form-label">Price (Rs.)</label>
                <input type="number" id="edit_price" name="price" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-secondary" id="cancelEditProduct">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#showAddProductForm').click(() => $('#addProductForm').slideToggle());
    $('#cancelAddProduct').click(() => {
        $('#addProductForm').slideUp();
        $('#newProductForm')[0].reset();
    });

    $('#cancelEditProduct').click(() => {
        $('#editOverlay').fadeOut();
        $('#editProductForm')[0].reset();
    });

    // Add New Product
    $('#newProductForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('addproducts') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#addProductForm').slideUp();
                $('#newProductForm')[0].reset();
                $('#productList').html(response.html);
                showCustomAlert(response.message, "success");
            },
            error: function (xhr) {
                showCustomAlert("Error adding product", "error");
            }
        });
    });

    // Show Edit Form
    $(document).on('click', '.edit-btn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let price = $(this).data('price');

        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_price').val(price);
         $('#editOverlay').css('display', 'flex').hide().fadeIn();
    });

    // Update Product
    $('#editProductForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('updateproduct') }}", // Make sure this route exists
            type: "POST",
            data: formData,
            success: function (res) {
                $('#editOverlay').fadeOut();
                $('#editProductForm')[0].reset();
                $('#productList').html(res.html);
                showCustomAlert(res.message, "success");
            },
            error: function () {
                showCustomAlert("Update failed", "error");
            }
        });
    });

    // Delete Product
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        let card = $(this).closest('.col');

        showCustomConfirm("Are you sure?", function () {
            $.ajax({
                url: `/deleteproduct/${id}`,
                type: 'DELETE',
                success: function (res) {
                    if (res.status === 'success') {
                        card.fadeOut(300, function () { $(this).remove(); });
                        showCustomAlert("Deleted", "success");
                    } else {
                        showCustomAlert("Failed", "error");
                    }
                }
            });
        });
    });

    // Live Search
    $('#searchProduct').on('keyup', function () {
        let keyword = $(this).val();
        $.ajax({
            url: "{{ route('search.products') }}",
            type: "GET",
            data: { keyword },
            success: function (data) {
                $('#productList').html(data);
            }
        });
    });
});
</script>
@endsection
