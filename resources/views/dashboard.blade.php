@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center" style="color: white">Bem-vindo(a) de volta, {{ Auth::user()->name }}.</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <h2 class="text-left">Área Participante</h2>
                <div class="d-flex justify-content-around">
                    <div class="card card-custom-questionnaire"style="background-color: white; color: #e52e71;">
                        Questionários
                    </div>
                    <div class="card card-custom-questionnaire" style="background-color:white; color: #e52e71;">
                        Questionários
                    </div>
                    <div class="card card-custom-questionnaire" style="background-color: white; color: #e52e71;">
                        Questionários
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <h2 class="text-left">Área Organizador</h2>
                <div class="d-flex justify-content-around">
                    <div class="ccard card-custom-questionnaire" style="background-color: white; color: #e52e71;">
                        Meus Questionários
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
