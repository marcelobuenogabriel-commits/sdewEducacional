<section>
    <p class="text-muted mb-3">
        Atualize as informações do seu perfil e endereço de email.
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" id="profile-form">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Nome</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2">
                    <p class="mb-0">
                        Seu endereço de email não está verificado.
                        <button form="send-verification" class="btn btn-link p-0">
                            Clique aqui para reenviar o email de verificação.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 mb-0 text-success">
                            Um novo link de verificação foi enviado para seu endereço de email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success ml-2">
                    <i class="fas fa-check"></i> Salvo com sucesso!
                </span>
            @endif
        </div>
    </form>
</section>
