@extends('general')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="card card-custom">
                        <div class="card-body card-body-home card-text text-center " style="margin: 0 auto">
                            <img class="logo" src="{{ asset('images/logo.png') }}" alt="árvore lúdica e colorida">
                            <div class="card-text text-center fs-2 mt-4 ">{{ __('Login') }}</div>

                            <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 mt-3">
                                <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3 mt-3">
                                <input placeholder="Senha" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="row mb-3 mt-2">
                                <div class="col-md-6">
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label " for="remember">
                                            {{ __('Permanecer logado') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Recuperar senha') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-0">
                                <center>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-custom">
                                            {{ __('Acessar') }}
                                        </button>
                                    </div>
                                </center>
                            </div>

                            <div>
                                <center>
                                    <a href="{{ route('register') }}" class="btn btn-link">Não tem uma conta? Cadastre-se</a>
                                </center>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection