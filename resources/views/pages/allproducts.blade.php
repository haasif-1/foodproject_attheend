@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Products /</span> All Products
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Available Products</h5>
        </div>
        <div class="card-body">
            <form id="addToCartForm">
                @csrf
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
                    @foreach ($products as $pro)
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset('storage/products/'.$pro->image) }}" alt="Product Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pro->name }}</h5>
                                    <p class="card-text text-primary fw-semibold">Rs. {{ $pro->price }}</p>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="products[]" value="{{ $pro->id }}" id="product-{{ $pro->id }}">
                                        <label class="form-check-label" for="product-{{ $pro->id }}">
                                            Select this product
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary" id="addToCartBtn">
                            <i class="bx bx-cart-add me-1"></i> Add to Cart
                        </button>
                        <a href="{{ route('user_dashboard') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  $(document).ready(function () {
    // Ensure CSRF token is included
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $('#addToCartForm').on('submit', function (e) {
      e.preventDefault();
      let formData = $(this).serialize();

      $.ajax({
        url: "{{ route('saveafterselect') }}",
        type: "POST",
        data: formData,
        success: function (response) {
          showCustomAlert("✅ Products added to cart successfully!", "success");
        },
        error: function (xhr) {
          showCustomAlert("❌ Failed to add products. Try again.", "error");
        }
      });
    });
  });
</script>
@endsection

