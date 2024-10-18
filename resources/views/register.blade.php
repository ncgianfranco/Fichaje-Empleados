<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Registro</title>
</head>
<body>
    <h1>Registrarse</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{old('name')}}" required autofocus />
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{old('email')}}" required/>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required />
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"/>
        </div>
    
        <button type="submit">Register</button>
    </form>
    
    <br>
</body>
</html>