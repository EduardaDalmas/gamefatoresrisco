@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('home') }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col-auto">
                                <h4>Criar questionário</h4>
                            </div>
                        </div>
                  
                        <form action="{{ route("questionnaire.save") }}" method="POST">
                            @csrf
                            <div class="form-group col-12">
                                <label for="name" id="labelNome">Nome do questionário</label><span class="text-danger fw-bold"> *</span>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group col-12">
                                <label for="description" id="labelObjetivo">Objetivo</label>
                                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-check col-12 mb-3">
                                <input class="form-check-input" type="checkbox" name="roulette" id="roulette">
                                <label class="form-check-label" for="roulette">
                                    Utilizar a roleta
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Você deseja apresentar as perguntas de que maneira?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="presentation" id="random" value="random">
                                    <label class="form-check-label" for="random">
                                        Aleatório
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="presentation" id="sequential" value="sequential" checked>
                                    <label class="form-check-label" for="sequential">
                                        Sequencial
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="col-2">
                                    <button type="submit" class="btn btn-custom">Salvar</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
