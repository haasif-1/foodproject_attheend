<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        form input:focus {
            border-color: #007bff;
        }

        form button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .footer-text {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="{{route ('adduser')}}" method="post" >

            @csrf
            <input type="text" name="name" placeholder="Enter name" required>
            <br>

            <input type="email" name="email" placeholder="Enter email" required>
            <br>

            <input type="password" name="password" placeholder="Enter password" required>
            <br>

            <button type="Add">Register</button>
        </form>

        <form action="{{ route('admin_dashboard') }}" class="back-button-form">
            <button type="submit">Back to Dashboard</button>
        </form>

    </div>
</body>
</html>
