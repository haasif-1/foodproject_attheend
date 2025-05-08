<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password</title>
</head>
<body>

<h1>Change Your Password</h1>
<form action="{{route('changedone',$data->id)}}"  method="post">
@csrf
<input type="text" name="pass"  value="{{$data->password}}" placeholder="Old password">

<br>
<input type="text" name="password" placeholder="enter New password">

<br>

<button>Change</button>

</form>

</body>
</html>
