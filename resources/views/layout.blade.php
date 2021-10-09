<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Management</title>
</head>
<body>
    @guest
        <a href="{{ route('register') }}">Register</a> | 
        <a href="{{ route('login') }}">Login</a> |
        Welcome Guest
    @else
        Welcome {{ Auth::user()->name }} |
        <a href="javascript:void(0);">Payment</a> |
        <a href="{{ route('role.create') }}">Add Role</a> |
        <a href="{{ route('role.index') }}">List Role</a> |
        <a href="{{ route('profile.index') }}">Profile</a> |
        <a href="javascript:void(0);">Upload</a> |
        <a href="javascript:void(0);">Email</a> |
        <a href="javascript:void(0);" onclick="user_logout();">Logout</a> 
        <form id="user_logout" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
        <script>
            function user_logout(){
                document.getElementById('user_logout').submit();
            }
        </script>
    @endguest

    @yield('title')
    @yield('content')
    
</body>
</html>