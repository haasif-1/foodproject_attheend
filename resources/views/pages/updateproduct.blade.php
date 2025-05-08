<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update product</title>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #f8f9fa;
            --light: #ffffff;
            --dark: #212529;
            --border-radius: 8px;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--secondary);
            color: var(--dark);
            line-height: 1.6;
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: var(--light);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        button {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary);
            color: var(--light);
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Product Data</h1>
        <form action="{{ route('editproduct', $edit->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            @csrf

            <div class="form-group">
                <input type="text" name="name" value="{{ $edit->name }}" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <input type="text" name="price" value="{{ $edit->price }}" placeholder="Enter product price" required>
            </div>

            <button type="submit">Update Product</button>

            <p class="form-footer">Edit the fields above and click update to save changes</p>
        </form>
    </div>
</body>
</html>
