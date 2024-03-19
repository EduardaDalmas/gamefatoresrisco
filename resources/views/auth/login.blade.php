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
                        <div class="card-text text-center fs-2 mt-4 ">{{ __('Login') }}</div>

                        <div class="mt-5">
                            <input type="usuario" class="form-control" id="exampleFormControlInput1" placeholder="Usuário">
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="Turma" class="form-control" id="exampleFormControlInput1" placeholder="Turma">
                        </div>
                        <a  href="{{ route('game') }}" class="btn btn-custom mt-3">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>