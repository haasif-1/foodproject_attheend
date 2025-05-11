<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Data</title>
</head>
<body>

    <h1>My information page</h1>

    <table border="1">
      <tr>
        <td>Name</td>
        <td>Email</td>
        <td>Password</td>
        <td>operation
        </td>

      </tr>


      <tr>
    <td>{{$data->name}}</td>
    <td>{{$data->email}}</td>
    <td>{{$data->password}}</td>
    <td>
    <a href="{{ route('updateuserdata')}}">Update</a>
  </td>
      </tr>

    </table>

      <form action="{{ route('user_dashboard') }}"  class="back-button-form">
           
            <button type="submit">Back to Dashboard</button>
        </form>



</body>
</html>
