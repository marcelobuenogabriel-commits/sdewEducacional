@extends('adminlte::auth.login')

@section('auth_header', 'Sdew Educacional')

@section('auth_body')
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group mb-3">
            <input type="email" 
                   id="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Email"
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   placeholder="Senha"
                   required 
                   autocomplete="current-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
            <!-- Remember Me -->
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">
                        Lembrar-me
                    </label>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
        </div>
    </form>

    @if (Route::has('password.request'))
        <p class="mb-1 mt-3">
            <a href="{{ route('password.request') }}">Esqueci minha senha</a>
        </p>
    @endif
@stop
