<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assign role</title>
</head>
<body>
    <form action="{{ route('selectedone') }}" method="POST">
        @csrf

        <label for="user_id">Select a User:</label>

        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}"> {{ $user->name }} </option>
            @endforeach
        </select>
<br>

<h3>Select Products:</h3>

@foreach($products as $product)
    <div>
        <input type="checkbox" name="product_ids[]" value="{{ $product->id }}">
        <label>{{ $product->name }}</label>
    </div>
@endforeach

<br>

        <button type="submit">Submit</button>
    </form>

    <form action="{{route('admin_dashboard')}}" class="back-button-form">
        <button type="submit">Back to Dashboard</button>
    </form>


</body>
</html>