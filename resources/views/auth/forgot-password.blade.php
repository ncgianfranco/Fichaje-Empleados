<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" class="form-control" id="email" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar enlace de recuperación</button>
</form>
