<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Required if you use the Sneat icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/js/helpers.js"></script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="#" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- You can add your logo here -->
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <!-- Products -->
                    <li class="menu-item">
                        <a href="{{ route('adding') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-plus-circle"></i>
                            <div>Add Products</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('showitem') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-list-ul"></i>
                            <div>Products List</div>
                        </a>
                    </li>

                    <!-- Users -->
                    <li class="menu-item">
                        <a href="{{ route('userlist') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>Users List</div>
                        </a>
                    </li>

                    <!-- Orders -->
                    <li class="menu-item">
                        <a href="{{ route('orderslist') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div>Orders List</div>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="menu-item">
                        <a href="{{ route('login') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-log-out"></i>
                            <div>Log Out</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <h4 class="mb-0">Admin Dashboard</h4>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="card-title text-primary">Welcome Admin</h1>
                                        <p class="mb-4">
                                            You are now logged in to the administration dashboard.
                                            Use the sidebar to navigate between different sections.
                                            All your actions are securely logged and protected.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © <script>document.write(new Date().getFullYear())</script> Food Project Admin
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/popper/popper.js"></script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/js/bootstrap.js"></script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/vendor/js/menu.js"></script>
    
    <!-- Main JS -->
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/js/main.js"></script>
</body>
</html>
