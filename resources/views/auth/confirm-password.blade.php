<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Confirmar senha') }}</h3>
                <p class="text-muted small mb-4">
                    {{ __('Por segurança, confirme sua senha para continuar.') }}
                </p>

                <form method="POST" action="{{ url('/confirm-password') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Senha') }}</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                            required autofocus autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('Confirmar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
