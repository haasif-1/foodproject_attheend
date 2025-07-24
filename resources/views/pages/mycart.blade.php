@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Shopping /</span> My Cart</h4>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Selected Products</h5>
    </div>
    <div class="card-body">
      <form id="cartForm">
        @csrf

        @if(count($cartProducts) > 0)
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
          @foreach($cartProducts as $product)
          <div class="col">
            <div class="card h-100 position-relative">
              <div class="position-absolute top-0 start-0 m-2">
                <input class="form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}">
              </div>
              <img class="card-img-top" src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text text-primary fw-semibold">Rs. {{ $product->price }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="text-end">
          <button type="button" id="checkoutBtn" class="btn btn-primary">Checkout Selected Items</button>
        </div>

        @else
        <div class="alert alert-info">Your cart is empty.</div>
        @endif
      </form>
    </div>
  </div>
</div>

<!-- Modal Form -->
<div id="checkoutModal" class="modal-overlay" style="display:none;">
  <div class="modal-content">
    <form id="orderForm">
      <h5>Shipping Information</h5>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div id="selectedProductIds"></div>

      <input type="text" name="phone" class="form-control my-2" placeholder="Phone" required>
      <input type="text" name="country" class="form-control my-2" placeholder="Country" required>
      <input type="text" name="province" class="form-control my-2" placeholder="Province" required>
      <input type="text" name="city" class="form-control my-2" placeholder="City" required>
      <input type="text" name="street" class="form-control my-2" placeholder="Street Address" required>

      <div class="text-end">
        <button type="button" id="closeModal" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-success">Place Order</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  // Show Modal on Checkout Click
  $('#checkoutBtn').click(function() {
    let selected = $('input[name="products[]"]:checked');
    if (selected.length === 0) {
      showCustomAlert('Please select at least one product.');
      return;
    }

    // Add selected product ids to modal form
    let html = '';
    selected.each(function() {
      html += `<input type="hidden" name="products[]" value="${$(this).val()}">`;
    });
    $('#selectedProductIds').html(html);

    $('#checkoutModal').fadeIn();
  });

  // Close Modal
  $('#closeModal').click(function() {
    $('#checkoutModal').fadeOut();
  });

  // Place Order via AJAX
  $('#orderForm').submit(function(e) {
    e.preventDefault();
    let formData = $(this).serialize();

    $.ajax({
      url: "{{ route('placeorder') }}",
      type: 'POST',
      data: formData,
      success: function(response) {
        showCustomAlert('Order Placed Successfully!');
        $('#checkoutModal').fadeOut();

        // Fade out selected product cards
        $('input[name="products[]"]:checked').closest('.col').fadeOut();
      },
      error: function(xhr) {
        showCustomAlert('Error: ' + xhr.responseText);
        $('#orderForm button[type="submit"]').prop('disabled', false);
      }
    });
  });
});
</script>
@endsection
