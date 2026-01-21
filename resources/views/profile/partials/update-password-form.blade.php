<section>
    <p class="text-muted mb-3">
        Certifique-se de que sua conta está usando uma senha longa e aleatória para permanecer segura.
    </p>

    <form method="post" action="{{ route('password.update') }}" id="password-form">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">Senha Atual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password">Nova Senha</label>
            <input id="update_password_password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password', 'updatePassword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Confirmar Nova Senha</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Atualizar Senha
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success ml-2">
                    <i class="fas fa-check"></i> Senha atualizada com sucesso!
                </span>
            @endif
        </div>
    </form>
</section>
