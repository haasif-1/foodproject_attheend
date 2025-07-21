<!DOCTYPE html>
<html lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Food Ordering System</title>

  <!-- Favicon + Styles -->
  @include('pages.layoutpages.links')

  <style>
    /* ✅ Custom Alert Box */
    .custom-alert {
      display: none;
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #28a745;
      color: white;
      padding: 15px 20px;
      border-radius: 8px;
      z-index: 9999;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      font-family: Arial, sans-serif;
    }

    .custom-alert.error {
      background-color: #dc3545;
    }

    .custom-alert .close-btn {
      margin-left: 15px;
      cursor: pointer;
      font-weight: bold;
    }

    /* ✅ Custom Confirm Box */
    .custom-confirm {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      color: #333;
      padding: 20px 25px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
      z-index: 10000;
      min-width: 300px;
      text-align: center;
      font-family: Arial, sans-serif;
      animation: fadeInScale 0.3s ease;
    }

    .custom-confirm h4 {
      margin-bottom: 15px;
      font-size: 18px;
    }

    .custom-confirm .btn {
      margin: 0 10px;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      font-size: 14px;
    }

    .custom-confirm .btn-confirm {
      background-color: #28a745;
      color: white;
    }

    .custom-confirm .btn-cancel {
      background-color: #dc3545;
      color: white;
    }

    @keyframes fadeInScale {
      from {
        opacity: 0;
        transform: scale(0.9) translate(-50%, -50%);
      }
      to {
        opacity: 1;
        transform: scale(1) translate(-50%, -50%);
      }
    }
  </style>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('pages.layoutpages.sidebar')

      <!-- Layout page -->
      <div class="layout-page">
        @include('pages.layoutpages.header')

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
          </div>

          @include('pages.layoutpages.footer')

          <div class="content-backdrop fade"></div>
        </div>
        <!-- /Content wrapper -->
      </div>
      <!-- /Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <!-- JS -->
  @include('pages.layoutpages.script')

  <!-- ✅ Custom Alert Box -->
  <div id="customAlert" class="custom-alert">
    <span id="alertMsg"></span>
    <span class="close-btn" onclick="hideCustomAlert()">×</span>
  </div>

  <!-- ✅ Custom Confirm Box -->
  <div id="customConfirm" class="custom-confirm">
    <div class="confirm-box-content">
      <p id="confirmMsg">Are you sure?</p>
      <div class="confirm-buttons">
        <button class="btn btn-confirm" id="confirmYesBtn" onclick="confirmAction()">Yes</button>
        <button class="btn btn-cancel" onclick="cancelConfirm()">No</button>
      </div>
    </div>
  </div>

  <!-- ✅ JS Logic -->
  <script>
    // 🔔 Alert Box
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

    function hideCustomAlert() {
      document.getElementById("customAlert").style.display = "none";
    }

    // ✅ Confirm Box
    let confirmCallback = null;

    function showCustomConfirm(message, callback) {
      document.getElementById("confirmMsg").textContent = message;
      document.getElementById("customConfirm").style.display = "block";
      confirmCallback = callback;
    }

    function confirmAction() {
      if (confirmCallback) confirmCallback();
      document.getElementById("customConfirm").style.display = "none";
    }

    function cancelConfirm() {
      document.getElementById("customConfirm").style.display = "none";
    }
  </script>
</body>
</html>
