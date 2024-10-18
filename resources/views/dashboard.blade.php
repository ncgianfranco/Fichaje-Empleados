<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboar</title>
</head>
<body>
    <h1>Welcome to your Dashboard, {{ $user->name }}!</h1>
    <p>Your email is: {{ $user->email }}</p>
    <br>
    <a href="{{route('logout')}}">Logout</a>
</body>
</html>