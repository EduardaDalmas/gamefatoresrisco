@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body card-body-home card-text text-center " style="margin: 0 auto">
                        <img class="logo" src="{{ asset('images/logo.png') }}" alt="árvore lúdica e colorida">
                        <div class="card-text text-center fs-2 mt-4">{{ __('Cadastre-se') }}</div>

                        <div class="mt-5">
                            <input type="name" class="form-control" id="name" placeholder="Nome">
                        </div>
                        <div class="mt-3">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="password" class="form-control" id="password" placeholder="Senha">
                        </div>
                        <a  href="{{ route('game') }}" class="btn btn-custom mt-3">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>