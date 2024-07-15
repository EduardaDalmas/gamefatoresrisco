@extends('general')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="card card-custom">
                        <div class="card-body card-body-home card-text text-center " style="margin: 0 auto">
                            <img class="logo" src="{{ asset('images/logo.png') }}" alt="árvore lúdica e colorida">
                            <div class="card-text text-center fs-2 mt-4 ">{{ __('Resetar senha') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3 mt-3">
                                    <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <input placeholder="Senha" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <input  placeholder="Confirmar senha" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-custom">
                                            {{ __('Resetar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
