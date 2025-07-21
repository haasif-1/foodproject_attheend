@extends('layout.app')

@section('content')
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
                <input type="text" id="name"  name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price (Rs.)</label>
                <input type="number"  id="price" name="price" class="form-control" required>
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
                                    <a href="{{ route('editproduct', ['id' => $pro->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // CSRF token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $('#showAddProductForm').click(function () {
    $('#addProductForm').slideToggle();
});
    // Cancel form
    $('#cancelAddProduct').click(function () {
        $('#addProductForm').slideUp();
        $('#newProductForm')[0].reset();
    });

    // Submit form via AJAX
         $('#newProductForm').submit(function (e) {
            e.preventDefault();

            var name = $('#name').val();
            var price = $('#price').val();
            var img = document.getElementById("image").files[0];

            if (!img) {
                showCustomAlert("Please upload an image.", "error");
                return;
            }

            var img_extension = img.name.split(".").pop().toLowerCase();
            var allowed_extensions = ["jpg", "jpeg", "png"];

            if ($.inArray(img_extension, allowed_extensions) === -1) {
                showCustomAlert("Invalid image type. Only JPG, JPEG, and PNG are allowed.", "error");
                return;
            }

            if (img.size > 1 * 1024 * 1024) {
                showCustomAlert("Image size must be less than 1MB.", "error");
                return;
            }

            var formData = new FormData();
            formData.append('name', name);
            formData.append('price', price);
            formData.append('image', img);

           $.ajax({
    url: "{{ route('addproducts') }}",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
  success: function (response) {
    $('#newProductForm')[0].reset();
    showCustomAlert(response.message, "success");
    $('#addProductForm').slideUp();
    $('#productList').html(response.html);
},
    error: function (xhr) {
        let errorMessage = 'Something went wrong.';
        if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
        }

        showCustomAlert(errorMessage, "error");
    }
});

        });

    // Delete product
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        let card = $(this).closest('.col');

        showCustomConfirm("Are you sure you want to delete this product?", function () {
            $.ajax({
                url: `/deleteproduct/${id}`,
                type: 'DELETE',
                success: function (res) {
                    if (res.status === 'success') {
                        showCustomAlert("Product deleted successfully");
                        card.fadeOut(400, function () {
                            $(this).remove();
                        });
                    } else {
                        showCustomAlert("Failed to delete product", "error");
                    }
                },
                error: function () {
                    showCustomAlert("Server error occurred", "error");
                }
            });
        });
    });

    // Live Search
    $('#searchProduct').on('keyup', function () {
        let keyword = $(this).val();
        $.ajax({
            url: "{{ route('search.products') }}",
            method: 'GET',
            data: { keyword: keyword },
            success: function (data) {
                $('#productList').html(data);
            },
            error: function () {
                showCustomAlert("Failed to fetch search results", "error");
            }
        });
    });
});
</script>
@endsection
