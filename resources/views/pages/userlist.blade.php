<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User List</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 1rem;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius);
        }

        thead tr {
            background-color: var(--primary-color);
            color: white;
            text-align: left;
            font-weight: bold;
        }

        th, td {
            padding: 1.2rem 1.5rem;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
            transition: var(--transition);
        }

        tbody tr:nth-of-type(even) {
            background-color: #f8f9fa;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid var(--primary-color);
        }

        tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.1);
            transform: translateX(4px);
        }

        td {
            color: #495057;
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
        }

        .status-active {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .status-inactive {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        /* Back Button Form Styles */
        .back-button-form {
            max-width: 1200px;
            margin: 2rem auto 0;
            text-align: center;
        }

        .back-button-form button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--box-shadow);
            font-weight: 500;
        }

        .back-button-form button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .back-button-form button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .container {
                padding: 1rem;
            }

            table {
                display: block;
                overflow-x: auto;
            }

            th, td {
                padding: 0.8rem;
            }

            .back-button-form button {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Management List</h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Member Since</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agents as $agent)
                <tr>
                    <td>{{ $agent->name }}</td>
                    <td>{{ $agent->email }}</td>
                    <td>{{ $agent->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('deleteuser', ['id' => $agent->id]) }}">Delete</a>
                        <a href="{{ route('updateuser', ['id' => $agent->id]) }}">Update</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form action="{{route('admin_dashboard')}}" class="back-button-form">
        <button type="submit">Back to Dashboard</button>
    </form>
</body>
</html>
