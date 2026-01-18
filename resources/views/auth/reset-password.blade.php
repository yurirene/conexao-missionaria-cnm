<x-guest-layout>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center mb-3">{{ __('Redefinir senha') }}</h5>

            @if ($errors->any())
                <div class="alert alert-danger mb-3" role="alert">
                    {{ $errors->first('email') ?: $errors->first('password') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Nova senha') }}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirmar senha') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        required autocomplete="new-password">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('Redefinir senha') }}</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a class="text-decoration-none" href="{{ route('login') }}">{{ __('Voltar ao login') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>
