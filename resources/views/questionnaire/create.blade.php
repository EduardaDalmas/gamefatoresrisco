@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <form action="{{ route("questionnaire.save") }}" method="POST">
                            @csrf
                            <div class="form-group col-12">
                                <label for="name" id="labelNome">Questionário</label><span class="text-danger fw-bold"> *</span>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group col-12">
                                <label for="description" id="labelObjetivo">Objetivo</label>
                                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-check col-12">
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
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
