@extends('layout.app')

@section('content')

<style>
/* Custom alert styling */
.custom-alert {
  display: none;
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #28a745;
  color: white;
  padding: 15px 20px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0,0,0,0.3);
  z-index: 9999;
  font-size: 16px;
  animation: slideDown 0.5s ease forwards;
}

.custom-alert.error {
  background-color: #dc3545;
}

.custom-alert .close-btn {
  margin-left: 15px;
  cursor: pointer;
  font-weight: bold;
  float: right;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<!-- Page Content -->
<main>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Products /</span> Add New Product
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Food Product Management</h5>
                    <div class="card-body">
                        <form id="addP_form">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="productName" name="name" placeholder="Enter food product name" required />
                                </div>

                                <div class="col-md-6">
                                    <label for="productPrice" class="form-label">Product Price ($)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" id="productPrice" name="price" placeholder="Enter product price" required />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="productImage" name="image" accept="image/*" required />
                                <div class="form-text">Upload a high-quality image of the food product</div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" id="addP_Btn" class="btn btn-primary me-2">Add Food Product</button>
                                <a href="{{ route('admin_dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
                            </div>
                        </form>

                        <!-- Custom Alert Box -->
                        <div id="customAlert" class="custom-alert">
                            <span id="alertMsg">This is a custom alert!</span>
                            <span class="close-btn" onclick="hideCustomAlert()">&times;</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Alert function for success or error messages
    function showCustomAlert(message, type = 'success') {
        const alertBox = document.getElementById("customAlert");
        const alertMsg = document.getElementById("alertMsg");

        alertMsg.textContent = message;
        alertBox.classList.remove("error");
        if (type === 'error') {
            alertBox.classList.add("error");
        }

        alertBox.style.display = "block";
        setTimeout(() => {
            alertBox.style.display = "none";
        }, 4000);
    }

    // Hide alert
    function hideCustomAlert() {
        document.getElementById("customAlert").style.display = "none";
    }

    // CSRF setup globally for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Form submit handler
    $(document).ready(function () {
        $('#addP_form').submit(function (e) {
            e.preventDefault();

            var name = $('#productName').val();
            var price = $('#productPrice').val();
            var img = document.getElementById("productImage").files[0];

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
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    success: function (response) {
        $('#addP_form')[0].reset();
        showCustomAlert(response.message, "success");
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
    });
</script>


@endsection
