<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update User</title>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #f8f9fa;
            --light: #ffffff;
            --dark: #212529;
            --success: #4cc9f0;
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .form-container {
            background: var(--light);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
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

        input[type="text"]::placeholder {
            color: #aaa;
        }

        #id-field {
            background-color: #f5f5f5;
            color: #666;
            cursor: not-allowed;
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
            text-transform: uppercase;
            letter-spacing: 1px;
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

            .form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Update User Profile</h1>

        <form action="{{ route('editmyselfdata', $edit->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            @csrf

            <div class="form-group">
                <label for="id">User ID</label>
                <input type="text" id="id-field" name="id" value="{{ $edit->id }}" readonly>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $edit->name }}" placeholder="Enter new name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" value="{{ $edit->email }}" placeholder="Enter new email" required>
            </div>

            <button type="submit">Update Profile</button>

            <p class="form-footer">All fields are required</p>
        </form>
    </div>
</body>
</html>
