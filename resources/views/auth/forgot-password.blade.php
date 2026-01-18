<x-guest-layout>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center mb-3">{{ __('Esqueceu sua senha?') }}</h5>
            <p class="text-muted text-center small mb-3">
                {{ __('Informe seu email e enviaremos um link para redefinir sua senha.') }}
            </p>

            @if (session('status'))
                <div class="alert alert-success mb-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-3" role="alert">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Enviar link de redefinição') }}</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a class="text-decoration-none" href="{{ route('login') }}">{{ __('Voltar ao login') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
