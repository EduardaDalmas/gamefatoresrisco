@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-text text-center fs-2 mt-4">{{ __('Cadastre-se') }}</div>
                    <div class="card-body card-body-home card-text text-center " style="margin: 0 auto">
                        <img class="logo" src="{{ asset('images/logo.png') }}" alt="árvore lúdica e colorida">

                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="name">{{ __('Nome') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="password" >{{ __('Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm">{{ __('Confirmação da senha') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <!-- <a  href="{{ route('game') }}" class="btn btn-custom mt-3">Acessar</a> -->
                        <div class="form-group mb-2">
                            <center>
                                <button type="submit" class="btn btn-custom">
                                    {{ __('Registrar') }}
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
