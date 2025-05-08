<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USer Dashboard</title>
</head>
<body>

    <h1>Welcome User {{ $userdata->name }}  </h1>


<form action="{{route('userdatacheck')}}" method="post" >

    @csrf
<button>  My Info. </button>

</form>

<br>
<br>

<form action="{{route('changeuserpassword')}}" method="post" >
    @csrf
<button>  Change Password </button>

</form>

<form action="{{route('showmyproducts')}}" >
<button>  My products </button>

</form>

<form action="{{route('user.cart')}}" >
    <button>  My Orders </button>
    
    </form>
    




</body>
</html>
