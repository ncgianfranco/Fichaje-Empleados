<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Formulario centrado</title>
  </head>
  <body>
    <!-- Contenedor flexbox para centrar el formulario -->
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
      <form method="POST" action="{{ route('password.email') }}" class="border p-4 rounded shadow-sm" style="width: 100%; max-width: 400px;">
        @csrf
        <h3 class="text-center mb-4">Restablecer Contraseña</h3>

        <div class="mb-3">
          <label for="email" class="form-label">Correo electrónico:</label>
          <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </div>
      </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
