<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $email) }}" required>
    </div>
    <div class="form-group">
        <label for="password">Nueva contraseña:</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmar nueva contraseña:</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary">Restablecer contraseña</button>
</form>
