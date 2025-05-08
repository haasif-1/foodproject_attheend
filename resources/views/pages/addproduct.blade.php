<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Food Products</title>
    <style>
        :root {
            --primary-color: #4CAF50; /* Green theme for food products */
            --secondary-color: #f8f9fa;
            --accent-color: #FF9800; /* Orange accent */
            --text-color: #333;
            --border-radius: 5px;
            --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .marquee {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 0;
            margin-bottom: 2rem;
            font-weight: 500;
            font-size: 1.1rem;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        input[type="text"]::placeholder {
            color: #aaa;
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        button:hover {
            background-color: #3e8e41;
        }

        button:active {
            transform: scale(0.98);
        }

        .form-footer {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 1.5rem;
            }

            input[type="text"], button {
                padding: 10px 15px;
            }

            .marquee {
                font-size: 1rem;
                padding: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Food Product Management</h1>
        <div class="marquee">
            <marquee behavior="scroll" direction="left">Add Your New Food Product</marquee>
        </div>

        <form action="{{ route('addproducts') }}" method="post">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Enter food product name">
            </div>

            <div class="form-group">
                <input type="text" name="price" placeholder="Enter product price ($)">
            </div>

            <div class="form-group">
                <input type="text" name="quantity" placeholder="Enter product quantity ">
            </div>

            <button type="submit">Add Food Product</button>

            <p class="form-footer">Fill in all required fields to add a new food item</p>
        </form>
        <form action="{{ route('admin_dashboard') }}" class="back-button-form">
            <button type="submit">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>
