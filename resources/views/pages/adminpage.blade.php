<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #2c3e50;
            --primary-light: #34495e;
            --accent-color: #3498db;
            --text-color: #ecf0f1;
            --content-bg: #f9f9f9;
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: var(--content-bg);
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            color: var(--text-color);
            height: 100vh;
            position: fixed;
            padding: 20px 0;
            transition: all 0.3s;
            box-shadow: var(--shadow);
        }

        .sidebar-header {
            padding: 0 20px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 20px;
        }

        .nav-link {
            display: block;
            padding: 12px 15px;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background-color: var(--primary-light);
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: var(--accent-color);
            font-weight: 500;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .welcome-container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .welcome-title {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        .welcome-message {
            color: #7f8c8d;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Security Badge */
        .security-badge {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #27ae60;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
        }

        .security-badge i {
            margin-right: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Panel</h2>
        </div>
        <div class="sidebar-menu">
            <a href="{{ route('adding') }}" class="nav-link">
                <i class="fas fa-plus-circle"></i> Add Products
            </a>
            <a href="{{ route('register') }}" class="nav-link">
                <i class="fas fa-plus-circle"></i> Add user
            </a>
            <a href="{{ route('selectuser') }}" class="nav-link">
                <i class="fas fa-plus-circle"></i> Assign Products
            </a>

            <a href="{{ route('showitem') }}" class="nav-link">
                <i class="fas fa-list"></i> Products List
            </a>
            <a href="{{ route('userlist') }}" class="nav-link">
                <i class="fas fa-list"></i> Users List
            </a>

            <a href="{{ route('viewordertoadmin') }}" class="nav-link">
                <i class="fas fa-list"></i> Order List
            </a>

            <a href="{{ route('login') }}" class="nav-link">
                 Log Out
            </a>
           


        </div>
    </div>

    <div class="main-content">
        <div class="welcome-container">
            <h1 class="welcome-title">Welcome Admin</h1>
            <p class="welcome-message">
                You are now logged in to the administration dashboard.
                Use the sidebar to navigate between different sections.
                All your actions are securely logged and protected.
            </p>
        </div>
    </div>


</body>
</html>
